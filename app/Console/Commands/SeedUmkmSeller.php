<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedUmkmSeller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'umkm:seed-palembang {--fresh : Truncate existing data first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed UMKM sellers and products from Palembang API';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $this->info('Starting Palembang UMKM Seeder...');
        
        if ($this->option('fresh')) {
            $this->warn('This will delete existing UMKM data. Are you sure?');
            if (!$this->confirm('Continue?')) {
                $this->info('Operation cancelled.');
                return 0;
            }
            
            $this->info('Truncating existing UMKM data...');
            // You can add truncation logic here if needed
        }
        
        try {
            require_once base_path('database/seeds/PalembangUmkmSeeder.php');
            $seeder = new \PalembangUmkmSeeder();
            $seeder->setCommand($this);
            $seeder->run();
            
            $this->info('✅ Palembang UMKM Seeder completed successfully!');
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Seeder failed: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return 1;
        }
    }
}