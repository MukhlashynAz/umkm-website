<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::create([
            'company_name' => 'Nama Perusahaan',
            'description' => 'Deskripsi singkat perusahaan.',
            'address' => 'Alamat perusahaan',
            'phone' => '08xxxxxxxxxx',
            'email' => 'email@perusahaan.com',
            'instagram' => '@instagram',
            'logo' => null,
        ]);
    }
}