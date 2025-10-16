<?php

use Illuminate\Database\Seeder;
use App\User;
use Vanilo\Foundation\Models\Product;
use Vanilo\Product\Models\ProductState;
use Vanilo\Category\Models\TaxonomyProxy;
use Vanilo\Category\Models\TaxonProxy;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PalembangUmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // API endpoint untuk data UMKM Palembang
        $apiUrl = 'https://diskopukm.palembang.go.id/api/produks?sort%5B0%5D=createdAt%3Adesc&populate%5Bpenjual%5D%5Bpopulate%5D%5Bgambar%5D=%2A&populate%5Bgambar%5D=%2A&populate%5Bkategori_produk%5D=%2A&pagination%5BpageSize%5D=20';
        
        try {
            // Fetch data dari API
            $response = Http::timeout(30)->get($apiUrl);
            
            if (!$response->successful()) {
                throw new \Exception('Failed to fetch data from API: ' . $response->status());
            }
            
            $data = $response->json();
            
            if (!isset($data['data']) || !is_array($data['data'])) {
                throw new \Exception('Invalid API response format');
            }
            
            if ($this->command) {
                $this->command->info('Successfully fetched ' . count($data['data']) . ' products from Palembang UMKM API');
            } else {
                echo "Successfully fetched " . count($data['data']) . " products from Palembang UMKM API\n";
            }
            
        } catch (\Exception $e) {
            if ($this->command) {
                $this->command->error('Failed to fetch data from API: ' . $e->getMessage());
                $this->command->info('Using fallback data instead...');
            } else {
                echo "Failed to fetch data from API: " . $e->getMessage() . "\n";
                echo "Using fallback data instead...\n";
            }
            
            // Fallback data jika API tidak bisa diakses
            $data = $this->getFallbackData();
        }
        
        // Create or get taxonomy for UMKM products
        $umkmTaxonomy = TaxonomyProxy::firstOrCreate([
            'name' => 'Produk UMKM',
            'slug' => 'produk-umkm'
        ]);
        
        // Create categories
        $kategoriKuliner = TaxonProxy::firstOrCreate([
            'taxonomy_id' => $umkmTaxonomy->id,
            'name' => 'Kuliner',
            'slug' => 'kuliner',
            'parent_id' => null,
            'priority' => 1
        ]);
        
        $kategoriMakananMinuman = TaxonProxy::firstOrCreate([
            'taxonomy_id' => $umkmTaxonomy->id,
            'name' => 'Makanan dan Minuman',
            'slug' => 'makanan-dan-minuman',
            'parent_id' => null,
            'priority' => 2
        ]);
        
        $kategoriLainnya = TaxonProxy::firstOrCreate([
            'taxonomy_id' => $umkmTaxonomy->id,
            'name' => 'Lainnya',
            'slug' => 'lainnya',
            'parent_id' => null,
            'priority' => 3
        ]);
        
        $createdUsers = 0;
        $createdProducts = 0;
        
        foreach ($data['data'] as $item) {
            $attributes = $item['attributes'];
            $penjual = $attributes['penjual']['data']['attributes'] ?? null;
            
            if (!$penjual) {
                continue;
            }
            
            // Create or get seller user
            $seller = $this->createSeller($penjual);
            if ($seller->wasRecentlyCreated) {
                $createdUsers++;
            }
            
            // Create product
            $product = $this->createProduct($attributes, $seller, $kategoriKuliner, $kategoriMakananMinuman, $kategoriLainnya);
            if ($product) {
                $createdProducts++;
                
                // Download and attach product images
                $this->downloadProductImages($product, $attributes['gambar']['data'] ?? []);
            }
        }
        
        if ($this->command) {
            $this->command->info("Palembang UMKM Seeder completed successfully!");
            $this->command->info("Created {$createdUsers} new sellers");
            $this->command->info("Created {$createdProducts} new products");
        } else {
            echo "Palembang UMKM Seeder completed successfully!\n";
            echo "Created {$createdUsers} new sellers\n";
            echo "Created {$createdProducts} new products\n";
        }
    }
    
    /**
     * Create seller user from API data
     */
    private function createSeller(array $penjualData): User
    {
        $email = $penjualData['email'] ?? null;
        if (!$email) {
            $email = 'seller_' . Str::random(8) . '@palembang-umkm.com';
        }
        
        // Determine gender from API data
        $gender = $penjualData['jk_pemilik'] ?? 'Laki-laki';
        $firstName = $penjualData['nama_pemilik'] ?? $penjualData['username'] ?? 'Seller';
        $lastName = '';
        
        // Split name if it contains space
        if (strpos($firstName, ' ') !== false) {
            $nameParts = explode(' ', $firstName, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';
        }
        
        return User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $penjualData['nama_pemilik'] ?? $penjualData['username'] ?? 'UMKM Seller',
                'username' => Str::slug($penjualData['username'] ?? $firstName),
                'first_name' => $firstName,
                'last_name' => $lastName,
                'phone' => $penjualData['no_whatsapp'] ?? $penjualData['whatsapp_toko'] ?? '081234567890',
                'postal_code' => '30111', // Default Palembang postal code
                'address' => $penjualData['alamat_pemilik'] ?? $penjualData['alamat_toko'] ?? 'Palembang',
                'area_landmark' => $penjualData['kecamatan_pemilik'] ?? '',
                'city' => 'Palembang',
                'province' => 'Sumatera Selatan',
                'store_name' => $penjualData['nama_toko'] ?? 'Toko UMKM',
                'umkm_category' => $this->mapUmkmCategory($penjualData['jenis_usaha'] ?? 'kecil'),
                'product_category' => $penjualData['jenis_toko'] ?? 'Kuliner',
                'store_owner_name' => $penjualData['nama_pemilik'] ?? $firstName,
                'ktp_number' => $penjualData['nik_pemilik'] ?? '1234567890123456',
                'store_description' => $this->generateStoreDescription($penjualData),
                'store_logo' => $this->getStoreLogoUrl($penjualData),
                'profile_picture' => $this->getProfilePictureUrl($penjualData),
                'is_verified' => true,
                'user_type' => 'umkm_seller',
                'is_active' => true,
                'password' => Hash::make('password123'),
            ]
        );
    }
    
    /**
     * Create product from API data
     */
    private function createProduct(array $attributes, User $seller, $kategoriKuliner, $kategoriMakananMinuman, $kategoriLainnya): ?Product
    {
        $judul = $attributes['judul'] ?? 'Produk UMKM';
        $slug = Str::slug($judul);
        
        // Check if product already exists
        if (Product::where('slug', $slug)->exists()) {
            $slug = $slug . '-' . Str::random(4);
        }
        
        // Determine category based on product type
        $category = $kategoriLainnya;
        $productName = strtolower($judul);
        
        if (strpos($productName, 'makanan') !== false || 
            strpos($productName, 'minuman') !== false ||
            strpos($productName, 'pempek') !== false ||
            strpos($productName, 'tekwan') !== false ||
            strpos($productName, 'keripik') !== false ||
            strpos($productName, 'susu') !== false) {
            $category = $kategoriMakananMinuman;
        } elseif (strpos($productName, 'kuliner') !== false) {
            $category = $kategoriKuliner;
        }
        
        $product = Product::firstOrCreate([
            'slug' => $slug,
        ], [
            'user_id' => $seller->id,
            'name' => $judul,
            'sku' => 'PAL' . str_pad($attributes['id'] ?? rand(1000, 9999), 4, '0', STR_PAD_LEFT),
            'price' => (float) ($attributes['harga'] ?? 10000),
            'original_price' => (float) (($attributes['harga'] ?? 10000) * 1.2), // 20% markup
            'excerpt' => $this->generateExcerpt($attributes['deskripsi'] ?? ''),
            'description' => $attributes['deskripsi'] ?? 'Produk UMKM berkualitas tinggi dari Palembang.',
            'state' => ProductState::ACTIVE,
            'stock' => rand(10, 100),
            'weight' => rand(100, 1000) / 100, // 0.1 to 1.0 kg
            'length' => rand(10, 30),
            'width' => rand(10, 30),
            'height' => rand(5, 15),
            'ext_title' => $judul . ' - Produk UMKM Palembang',
            'meta_keywords' => $this->generateMetaKeywords($judul, $attributes['deskripsi'] ?? ''),
            'meta_description' => $this->generateMetaDescription($judul, $attributes['deskripsi'] ?? ''),
        ]);
        
        // Add product to category
        $product->addTaxon($category);
        
        return $product;
    }
    
    /**
     * Download and attach product images
     */
    private function downloadProductImages(Product $product, array $gambarData): void
    {
        if (empty($gambarData)) {
            return;
        }
        
        foreach ($gambarData as $gambar) {
            $imageUrl = 'https://diskopukm.palembang.go.id' . $gambar['attributes']['url'];
            
            try {
                // Download image with timeout
                $response = Http::timeout(30)->get($imageUrl);
                
                if ($response->successful()) {
                    // Save image to temporary file
                    $tempPath = tempnam(sys_get_temp_dir(), 'umkm_image_');
                    file_put_contents($tempPath, $response->body());
                    
                    // Add to media collection
                    $product->addMedia($tempPath)
                        ->usingName($gambar['attributes']['name'] ?? 'Product Image')
                        ->usingFileName($gambar['attributes']['name'] ?? 'product_image.jpg')
                        ->toMediaCollection('default');
                    
                    // Clean up temp file
                    if (file_exists($tempPath)) {
                        unlink($tempPath);
                    }
                    
                    Log::info("Successfully downloaded image for product: {$product->name}");
                } else {
                    Log::warning("Failed to download image for product {$product->name}: HTTP {$response->status()}");
                }
            } catch (\Exception $e) {
                Log::warning("Failed to download image for product {$product->name}: " . $e->getMessage());
            }
        }
    }
    
    /**
     * Map UMKM category from API data
     */
    private function mapUmkmCategory(?string $jenisUsaha): string
    {
        if (!$jenisUsaha) {
            return 'kecil';
        }
        
        $jenisUsaha = strtolower($jenisUsaha);
        
        if (strpos($jenisUsaha, 'mikro') !== false) {
            return 'mikro';
        } elseif (strpos($jenisUsaha, 'menengah') !== false) {
            return 'menengah';
        }
        
        return 'kecil';
    }
    
    /**
     * Generate store description
     */
    private function generateStoreDescription(array $penjualData): string
    {
        $namaToko = $penjualData['nama_toko'] ?? 'Toko UMKM';
        $jenisToko = $penjualData['jenis_toko'] ?? 'Kuliner';
        $alamat = $penjualData['alamat_toko'] ?? 'Palembang';
        
        return "{$namaToko} adalah toko UMKM yang bergerak di bidang {$jenisToko}. 
                Berlokasi di {$alamat}, kami menyediakan produk berkualitas tinggi dengan harga yang terjangkau. 
                Dikelola dengan penuh dedikasi untuk memberikan pelayanan terbaik kepada pelanggan.";
    }
    
    /**
     * Get store logo URL
     */
    private function getStoreLogoUrl(array $penjualData): ?string
    {
        $gambar = $penjualData['gambar']['data'] ?? null;
        if ($gambar && isset($gambar['attributes']['url'])) {
            return 'https://diskopukm.palembang.go.id' . $gambar['attributes']['url'];
        }
        
        // Fallback to default logo
        return 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=200&h=200&fit=crop&crop=center';
    }
    
    /**
     * Get profile picture URL
     */
    private function getProfilePictureUrl(array $penjualData): ?string
    {
        // Use gender to determine appropriate profile picture
        $gender = $penjualData['jk_pemilik'] ?? 'Laki-laki';
        
        if (strtolower($gender) === 'perempuan') {
            return 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=200&h=200&fit=crop&crop=face';
        }
        
        return 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=200&h=200&fit=crop&crop=face';
    }
    
    /**
     * Generate excerpt from description
     */
    private function generateExcerpt(string $description): string
    {
        $excerpt = strip_tags($description);
        $excerpt = preg_replace('/\s+/', ' ', $excerpt);
        
        if (strlen($excerpt) > 150) {
            $excerpt = substr($excerpt, 0, 147) . '...';
        }
        
        return $excerpt ?: 'Produk UMKM berkualitas tinggi dari Palembang.';
    }
    
    /**
     * Generate meta keywords
     */
    private function generateMetaKeywords(string $judul, string $description): string
    {
        $keywords = ['umkm', 'palembang', 'produk lokal', 'indonesia'];
        
        // Extract keywords from title
        $titleWords = explode(' ', strtolower($judul));
        $keywords = array_merge($keywords, array_slice($titleWords, 0, 3));
        
        // Add common UMKM keywords
        $umkmKeywords = ['makanan khas', 'kerajinan', 'kuliner', 'tradisional'];
        $keywords = array_merge($keywords, $umkmKeywords);
        
        return implode(', ', array_unique($keywords));
    }
    
    /**
     * Generate meta description
     */
    private function generateMetaDescription(string $judul, string $description): string
    {
        $metaDesc = $this->generateExcerpt($description);
        return "{$judul} - {$metaDesc} Produk UMKM berkualitas dari Palembang.";
    }
    
    /**
     * Fallback data if API is not accessible
     */
    private function getFallbackData(): array
    {
        return [
            'data' => [
                [
                    'id' => 1,
                    'attributes' => [
                        'judul' => 'Keripik Rumput Laut Ulva',
                        'deskripsi' => 'Keripik Rumput Laut jenis Rumput Laut Ulva Lactuca yang diolah menjadi makanan ringan dengan varian rasa. Rasa Jagung Bakar, Rasa Barbeque, Rasa Balado Pedas Manis. Rasanya Kressh dan renyah saat digigit.',
                        'harga' => '10000',
                        'penjual' => [
                            'data' => [
                                'attributes' => [
                                    'username' => 'ELHA',
                                    'email' => 'elha@palembang-umkm.com',
                                    'nama_toko' => 'ELHA',
                                    'nama_pemilik' => 'Lily Irawati',
                                    'jk_pemilik' => 'Perempuan',
                                    'alamat_pemilik' => 'Griya Sako Permai',
                                    'kecamatan_pemilik' => 'Sako',
                                    'alamat_toko' => 'Griya Sako Permai Palembang',
                                    'jenis_toko' => 'Kuliner',
                                    'no_whatsapp' => '082179968510',
                                    'whatsapp_toko' => '082179968510',
                                    'nik_pemilik' => '1671034107710042',
                                ]
                            ]
                        ],
                        'gambar' => [
                            'data' => [
                                [
                                    'attributes' => [
                                        'name' => 'keripik-rumput-laut.jpg',
                                        'url' => '/uploads/keripik-rumput-laut.jpg'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'id' => 2,
                    'attributes' => [
                        'judul' => 'Pempek Campur',
                        'deskripsi' => 'Pempek Campur isi 25 dengan cita rasa khas Palembang. Terbuat dari ikan segar dan tepung sagu pilihan.',
                        'harga' => '100000',
                        'penjual' => [
                            'data' => [
                                'attributes' => [
                                    'username' => 'PEMPEK UMIABI',
                                    'email' => 'pempek@palembang-umkm.com',
                                    'nama_toko' => 'PEMPEK UMIABI',
                                    'nama_pemilik' => 'MOHAMMAD DIMAS ABID',
                                    'jk_pemilik' => 'Laki-laki',
                                    'alamat_pemilik' => 'JL. AKBP H.UMAR NO. 598 RT 022/001',
                                    'kecamatan_pemilik' => 'Kemuning',
                                    'alamat_toko' => 'JL. AKBP H.UMAR NO. 598 RT 022/001',
                                    'jenis_toko' => 'Makanan dan Minuman',
                                    'no_whatsapp' => '081273033204',
                                    'whatsapp_toko' => '081273033204',
                                    'nik_pemilik' => '1234567890123456',
                                ]
                            ]
                        ],
                        'gambar' => [
                            'data' => [
                                [
                                    'attributes' => [
                                        'name' => 'pempek-campur.jpg',
                                        'url' => '/uploads/pempek-campur.jpg'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}