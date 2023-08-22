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
            ['2312218001', 'NEISHA ARRIVA ZAHRA', 'P', '085163097903'],
            ['2312218002', 'CINDI AMELIA PUTRI', 'P', '081515877536'],
            ['2312218003', 'DINA FIRDA SAFITRI', 'P', '081522677401'],
            ['2312218004', 'TITI WINDIANI', 'P', '082231834032'],
            ['2312218005', 'WISMA RAHIFAH', 'P', '081258017451'],
            ['2312218006', 'RAIHAN NAZUAR GIFARI EFFENDI', 'L', '081255042527'],
            ['2312218007', 'SYAHRUDIN', 'L', '082215765799'],
            ['2312218008', 'AMUL LIHAN', 'P', '081522724127'],
            ['2312218009', 'SYIFA AULIA PUTRI', 'P', '083150041770'],
            ['2312218010', 'RAIHAN', 'L', '081223900316'],
            ['2312218011', 'FIRDA LATIFAH ASHARI', 'P', '081351670658'],
            ['2312218012', 'INTAN NUR AINI', 'P', '082253161176'],
            ['2312218013', 'ANNAS NUR ABDILLAH', 'L', '082158451648'],
            ['2312218014', 'MELATI', 'P', '085394403492'],
            ['2312218015', 'ANISA TATIA PUTRI', 'P', '085256353218'],

        ];

        foreach ($studentData as $data) {
            $nim = $data[0];
            $nama = $data[1];
            $jk = $data[2];
            $noHp = $data[3];

            DB::table('users')->insert([
                [
                    'id' => $nim,
                    'name' => $nama,
                    'username' => $nim,
                    'password' => Hash::make($nim)
                ],
            ]);
            DB::table('profiles')->insert([
                [
                    'user_id' => $nim,
                    'phone' => $noHp,
                    'gender' => $jk,
                    'joined_at' => now(),
                ],
            ]);

            DB::table('siakad')->insert([
                [
                    'user_id' => $nim,
                    'faculty_id' => 1,
                    'department_id' => 8,
                    'local_id' => NULL,
                ],
            ]);
        }
    }
}
