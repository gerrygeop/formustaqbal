<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentData = [
            ['2341919001', 'MUHAMMAD FARHAN IBRAHIM', 'L', '081351795207'],
            ['2341919002', 'RIAN AFRISAL', 'L', '085753472714'],
            ['2341919003', 'JUMIYATI', 'P', '087882758954'],
            ['2341919004', 'ANUGRAH YUNANDA', 'L', '082199998885'],
            ['2341919005', 'RIA RESTIA NINGSIH', 'P', '085754616309'],
            ['2341919006', 'ABDUL KHAKIM', 'L', '0895605118379'],
            ['2341919007', 'MUHAMMAD DIMAS HERIYADI', 'L', '082149499869'],
            ['2341919008', 'AULIA PUTRI MALANTI', 'P', '083846170983'],
            ['2341919009', 'MUHAMMAD RIZKY RINALDI', 'L', '082346951954'],
            ['2341919010', 'RIA', 'P', '082198050677'],
            ['2341919011', 'AHMAD YUSUF ANUGRAH', 'L', '082348249317'],
            ['2341919012', 'MUHAMMAD AMIN ABDILLAH', 'L', '085363578507'],
            ['2341919013', 'MUHAMMAD ARIFIN ILHAM', 'L', '082154920431'],
            ['2341919014', 'MIDA HERLINA', 'P', '085388610903'],
            ['2341919015', 'MUHAMMAD KHAIDIR ALI', 'L', '082259218635'],
            ['2341919016', 'FAIZ ALANUHA', 'L', '081345189515'],
            ['2341919017', 'ACHMAD ALDI SAPUTRA', 'L', '081345417018'],
            ['2341919018', 'RENO RIZKY', 'L', '082152254978'],
            ['2341919019', 'NAUFAL AKMAL ARIIQA', 'L', '905363898064'],
            ['2341919021', 'MUHAMMAD ALDI PRASETYA', 'L', '082149252556'],
            ['2341919022', 'MUHAMMAD HAYKAL ABRAR', 'L', '082189642784'],
            ['2341919023', 'MUHAMMAD HAIKAL HUSAIN', 'L', '083846172043'],
            ['2341919024', 'BAGUS HIDAYAT SUTARA', 'L', '081348514652'],
        ];

        foreach ($studentData as $data) {
            $nim = $data[0];
            $nama = $data[1];
            $jk = $data[2];
            $noHp = $data[3];

            $userId = DB::table('users')->insertGetId([
                'name' => $nama,
                'username' => $nim,
                'password' => Hash::make($nim)
            ]);

            DB::table('profiles')->insert([
                'user_id' => $userId,
                'phone' => $noHp,
                'gender' => $jk,
                'joined_at' => now(),
            ]);

            DB::table('siakad')->insert([
                [
                    'user_id' => $userId,
                    'faculty_id' => 4,
                    'department_id' => 19,
                    'local_id' => NULL,
                ],
            ]);
        }
    }
}
