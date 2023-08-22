<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ["Fakultas Tarbiyah dan Ilmu Keguruan", "Fakultas Syari'ah", "Fakultas Ekonomi dan Bisnis Islam", "Fakultas Ushuluddin Adab dan Dakwah"];

        // Fakultas Tarbiyah dan Ilmu Keguruan
        // ["Pendidikan Agama Islam", "Manajemen Pendidikan Islam", "Pendidikan Bahasa Arab", "Tadris Bahasa Inggris", "Pendidikan Guru Madrasah Ibtidaiyah", "Pendidikan Islam Anak Usia Dini", "Tadris Matematika", "Tadris Biologi"];

        // Fakultas Syari'ah
        // ["Hukum Keluarga", "Hukum Ekonomi Syariah", "Hukum Tata Negara"];

        // Fakultas Ekonomi dan Bisnis Islam
        // ["Ekonomi Syariah", "Perbankan Syariah", "Manajemen Bisnis Syariah"];

        // Fuad
        // ["Manajemen Dakwah", "Komunikasi dan Penyiaran Islam", "Bimbingan Konseling Islam", "Ilmu Al-Qur`an dan Tafsir", "Sistem Informasi"];

        DB::table('faculties')->insert([
            ['name' => "Fakultas Tarbiyah dan Ilmu Keguruan"],
            ['name' => "Fakultas Syari'ah"],
            ['name' => "Fakultas Ekonomi dan Bisnis Islam"],
            ['name' => "Fakultas Ushuluddin Adab dan Dakwah"]
        ]);

        DB::table('departments')->insert([
            // Fakultas Tarbiyah dan Ilmu Keguruan
            ['faculty_id' => 1, 'name' => "Pendidikan Agama Islam"],
            ['faculty_id' => 1, 'name' => "Manajemen Pendidikan Islam"],
            ['faculty_id' => 1, 'name' => "Pendidikan Bahasa Arab"],
            ['faculty_id' => 1, 'name' => "Tadris Bahasa Inggris"],
            ['faculty_id' => 1, 'name' => "Pendidikan Guru Madrasah Ibtidaiyah"],
            ['faculty_id' => 1, 'name' => "Pendidikan Islam Anak Usia Dini"],
            ['faculty_id' => 1, 'name' => "Tadris Matematika"],
            ['faculty_id' => 1, 'name' => "Tadris Biologi"],

            // Fakultas Syari'ah
            ['faculty_id' => 2, 'name' => "Hukum Keluarga"],
            ['faculty_id' => 2, 'name' => "Hukum Ekonomi Syariah"],
            ['faculty_id' => 2, 'name' => "Hukum Tata Negara"],

            // Fakultas Ekonomi dan Bisnis Islam
            ['faculty_id' => 3, 'name' => "Ekonomi Syariah"],
            ['faculty_id' => 3, 'name' => "Perbankan Syariah"],
            ['faculty_id' => 3, 'name' => "Manajemen Bisnis Syariah"],

            // Fuad
            ['faculty_id' => 4, 'name' => "Manajemen Dakwah"],
            ['faculty_id' => 4, 'name' => "Komunikasi dan Penyiaran Islam"],
            ['faculty_id' => 4, 'name' => "Bimbingan Konseling Islam"],
            ['faculty_id' => 4, 'name' => "Ilmu Al-Qur`an dan Tafsir"],
            ['faculty_id' => 4, 'name' => "Sistem Informasi"]
        ]);

        DB::table('locals')->insert([
            // Fakultas Tarbiyah dan Ilmu Keguruan 1
            // PAI
            ['department_id' => 1, 'name' => 'PAI-1'],
            ['department_id' => 1, 'name' => 'PAI-2'],
            ['department_id' => 1, 'name' => 'PAI-3'],
            ['department_id' => 1, 'name' => 'PAI-4'],
            ['department_id' => 1, 'name' => 'PAI-5'],
            ['department_id' => 1, 'name' => 'PAI-6'],
            ['department_id' => 1, 'name' => 'PAI-7'],

            // MPI
            ['department_id' => 2, 'name' => 'MPI-1'],
            ['department_id' => 2, 'name' => 'MPI-2'],
            ['department_id' => 2, 'name' => 'MPI-3'],

            // PBA
            ['department_id' => 3, 'name' => 'PBA-1'],
            ['department_id' => 3, 'name' => 'PBA-2'],
            ['department_id' => 3, 'name' => 'PBA-3'],

            // TBI
            ['department_id' => 4, 'name' => 'TBI-1'],
            ['department_id' => 4, 'name' => 'TBI-2'],

            // PGMI
            ['department_id' => 5, 'name' => 'PGMI-1'],
            ['department_id' => 5, 'name' => 'PGMI-2'],
            ['department_id' => 5, 'name' => 'PGMI-3'],

            // PIAUD
            ['department_id' => 6, 'name' => 'PIAUD-1'],

            // TMT
            ['department_id' => 7, 'name' => 'TMT-1'],

            // TB
            ['department_id' => 8, 'name' => 'TB-1'],

            // Fakultas Syari'ah 2
            // HK
            ['department_id' => 9, 'name' => 'HK-1'],
            ['department_id' => 9, 'name' => 'HK-2'],
            ['department_id' => 9, 'name' => 'HK-3'],

            // HES
            ['department_id' => 10, 'name' => 'HES-1'],
            ['department_id' => 10, 'name' => 'HES-2'],

            // HTN
            ['department_id' => 11, 'name' => 'HTN-1'],
            ['department_id' => 11, 'name' => 'HTN-2'],
            ['department_id' => 11, 'name' => 'HTN-3'],

            // Fakultas Ekonomi dan Bisnis Islam 3
            // ES
            ['department_id' => 12, 'name' => 'ES-1'],
            ['department_id' => 12, 'name' => 'ES-2'],
            ['department_id' => 12, 'name' => 'ES-3'],

            // PS
            ['department_id' => 13, 'name' => 'PS-1'],
            ['department_id' => 13, 'name' => 'PS-2'],
            ['department_id' => 13, 'name' => 'PS-3'],

            // MBS
            ['department_id' => 14, 'name' => 'MBS-1'],
            ['department_id' => 14, 'name' => 'MBS-2'],
            ['department_id' => 14, 'name' => 'MBS-3'],

            // Fuad 4
            // MD
            ['department_id' => 15, 'name' => 'MD-1'],
            ['department_id' => 15, 'name' => 'MD-2'],

            // KPI
            ['department_id' => 16, 'name' => 'KPI-1'],
            ['department_id' => 16, 'name' => 'KPI-2'],

            // BKI
            ['department_id' => 17, 'name' => 'BKI-1'],
            ['department_id' => 17, 'name' => 'BKI-2'],

            // IAT
            ['department_id' => 18, 'name' => 'IAT-1'],
            ['department_id' => 18, 'name' => 'IAT-2'],
            ['department_id' => 18, 'name' => 'IAT-3'],

            // SI
            ['department_id' => 19, 'name' => 'SI-1'],
        ]);
    }
}
