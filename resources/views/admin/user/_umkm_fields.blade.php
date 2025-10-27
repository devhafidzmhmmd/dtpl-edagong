@if(old('user_type') === 'umkm_seller' || $user->user_type === 'umkm_seller' || str_contains(strtolower($user->email ?? ''), 'umkm'))
<div class="card mt-4" style="border-left: 4px solid #764ba2;">
    <div class="card-header bg-light">
        <h6 class="mb-0">
            <i class="ti ti-store me-2 text-primary"></i>Informasi UMKM
        </h6>
    </div>
    <div class="card-body">
        <!-- Store Logo -->
        <div class="mb-4">
            <label class="form-label">Logo Toko</label>
            <div class="d-flex align-items-center gap-4">
                <div>
                    @if($user->store_logo)
                        @php
                            // Check if it's a URL or a path
                            $logoUrl = str_starts_with($user->store_logo, 'http') 
                                ? $user->store_logo 
                                : asset('storage/' . $user->store_logo);
                        @endphp
                        <img src="{{ $logoUrl }}" 
                             alt="Store logo" 
                             class="rounded" 
                             height="100" 
                             width="100" 
                             style="object-fit: cover;"
                             onerror="this.onerror=null; this.src='{{ asset('assets/img/avatars/14.png') }}';">
                    @else
                        <div class="bg-light border rounded d-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px;">
                            <i class="ti ti-store fs-4 text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-grow-1">
                    <input type="file" 
                           name="store_logo" 
                           id="store_logo" 
                           class="form-control form-control-sm"
                           accept="image/png,image/jpeg,image/jpg,image/gif">
                    <small class="text-muted">Max 2MB, format: JPG, PNG, GIF</small>
                </div>
            </div>
            @error('store_logo')
                <div class="text-danger mt-1 small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Store Name -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Toko</label>
                <input type="text" 
                       name="store_name" 
                       value="{{ old('store_name', $user->store_name) }}" 
                       class="form-control form-control-sm">
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Pemilik</label>
                <input type="text" 
                       name="store_owner_name" 
                       value="{{ old('store_owner_name', $user->store_owner_name) }}" 
                       class="form-control form-control-sm">
            </div>
        </div>

        <!-- UMKM Category -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Kategori UMKM</label>
                <select name="umkm_category" class="form-select form-select-sm">
                    <option value="">Pilih Kategori</option>
                    <option value="mikro" {{ old('umkm_category', $user->umkm_category) === 'mikro' ? 'selected' : '' }}>Mikro</option>
                    <option value="kecil" {{ old('umkm_category', $user->umkm_category) === 'kecil' ? 'selected' : '' }}>Kecil</option>
                    <option value="menengah" {{ old('umkm_category', $user->umkm_category) === 'menengah' ? 'selected' : '' }}>Menengah</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori Produk</label>
                <input type="text" 
                       name="product_category" 
                       value="{{ old('product_category', $user->product_category) }}" 
                       class="form-control form-control-sm">
            </div>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Deskripsi Toko</label>
            <textarea name="store_description" 
                      class="form-control form-control-sm" 
                      rows="3">{{ old('store_description', $user->store_description) }}</textarea>
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="address" 
                      class="form-control form-control-sm" 
                      rows="2">{{ old('address', $user->address) }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Kota</label>
                <input type="text" 
                       name="city" 
                       value="{{ old('city', $user->city) }}" 
                       class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label class="form-label">Provinsi</label>
                <input type="text" 
                       name="province" 
                       value="{{ old('province', $user->province) }}" 
                       class="form-control form-control-sm">
            </div>
            <div class="col-md-4">
                <label class="form-label">Kode Pos</label>
                <input type="text" 
                       name="postal_code" 
                       value="{{ old('postal_code', $user->postal_code) }}" 
                       class="form-control form-control-sm">
            </div>
        </div>

        <!-- Phone & Verification -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" 
                       name="phone" 
                       value="{{ old('phone', $user->phone) }}" 
                       class="form-control form-control-sm">
            </div>
            <div class="col-md-6">
                <label class="form-label">Status Verifikasi</label>
                <div class="form-check form-switch mt-2">
                    <input type="hidden" name="is_verified" value="0">
                    <input type="checkbox" 
                           name="is_verified" 
                           value="1" 
                           {{ old('is_verified', $user->is_verified) ? 'checked' : '' }}
                           class="form-check-input" 
                           role="switch">
                    <label class="form-check-label">
                        {{ $user->is_verified ? 'Sudah Diverifikasi' : 'Belum Diverifikasi' }}
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

