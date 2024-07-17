<?php

namespace Database\Seeders;

use App\Models\Website;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebsiteSeeder extends Seeder
{
    private array $websites = array(
        ['name' => 'SubPlat 1 Website', 'url' => 'https://subplat1.com'],
        ['name' => 'SubPlat 2 Website', 'url' => 'https://subplat2.com'],
        ['name' => 'SubPlat 3 Website', 'url' => 'https://subplat3.com']
    );

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->websites as $website) {
            Website::create(
                $website
            );
        }
    }
}
