<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            ['Aam Amaliatus Sholihah, M.Pd', '202301', '123456'],
            ['Abdul Basith, M.Pd', '202302', '123456'],
            ['Asngari, M.Pd', '202303', '123456'],
            ['Dieni Minhajuhayati, M.Pd', '202304', '123456'],
            ['Dr. Edy Murdani Z, M.Pd', '202305', '123456'],
            ['Dr. Luluk Humairo Pimada, M.Pd', '202306', '123456'],
            ['Drs. Materan, M.HI', '202307', '123456'],
            ['Eka Misminarti, M.Pd', '202308', '123456'],
            ['H. Marajo, Lc, M.Pd', '202309', '123456'],
            ['H. Susanto, Lc, M.Pd', '202310', '123456'],
            ['Khairuddin Khairi, Lc, MA', '202311', '123456'],
            ['Misbahul Fuad, M.Pd.I', '202312', '123456'],
            ['Moh. Nasrun, M.Pd', '202313', '123456'],
            ['Muhamad Fajri, M.Pd', '202314', '123456'],
            ['Muhammad Ali Ibrahim, M.Ud', '202315', '123456'],
            ['Muhammad Anhar, M.hum', '202316', '123456'],
            ['Muhammad Ihsanuddin Masdar, M.Pd', '202317', '123456'],
            ['Muhammad Rifai Lubis. Lc. MA', '202318', '123456'],
            ['Muhammad Solekhin, S.Pd.I, M.Pd', '202319', '123456'],
            ['Muhsinatun, M.Pd.I', '202320', '123456'],
            ['Nirhamna Hanif Fadillah, S.Sos.I, M.Pd', '202321', '123456'],
            ['Nur Fuadi Rahman, M.Pd', '202322', '123456'],
            ['Rahmatillah, M.Pd', '202323', '123456'],
            ['Rahmida, M.Pd', '202324', '123456'],
            ['Saipul Hadi, M.Pd', '202325', '123456'],
            ['Sulung Najmawati Zakiyya, S.Sy, M.H', '202326', '123456'],
            ['Syarifaturrahmatullah, M.Pd', '202327', '123456'],
            ['Tsalis Qori Fanani, M.Pd', '202328', '123456'],
            ['Yunita Noor Azizah, M.Pd.I', '202329', '123456'],
            ['Zaidan Anshari, BA, M.Ag', '202330', '123456'],
            ['Andi Achmad, M.Pd', '202331', '123456'],
            ['Arifsyah, M.Pd', '202332', '123456'],
            ['Athif Fadil, S.Pd.I, M.Pd', '202333', '123456'],
            ['Aulia Fahroni, S.HI, M.Pd', '202334', '123456'],
            ['Darmaizar Arif, Lc, M.Ag', '202335', '123456'],
            ['Dr. Misbahul Khairani, M.Pd', '202336', '123456'],
            ['Dwi Aprilia, M.Pd', '202337', '123456'],
            ["Hidayatus Sa'dah, M.Pd", '202338', '123456'],
            ['Husni Mubarok, M.Ag', '202339', '123456'],
            ['Khairun Nida, M.Pd', '202340', '123456'],
            ['M. Sudarta, M.Pd.I', '202341', '123456'],
            ['Mohammad Hanief Sirajulhuda, M.H', '202342', '123456'],
            ['Muhammad Arifin, M.Pd', '202343', '123456'],
            ['Muhammad Fathurrahman Hakim, M.Sos', '202344', '123456'],
            ['Muhammad Idris, M.Pd', '202345', '123456'],
            ['Putra Hadi, M.Pd', '202346', '123456'],
            ['Randy Muslim, M.Pd', '202347', '123456'],
            ['Saidi HS, M.Pd.I', '202348', '123456'],
            ['Sayid Muhammad Umar, M.H', '202349', '123456'],
            ['Taupik, M.Pd.I', '202350', '123456'],
            ['Wahyu Utami, Lc, M.Pd', '202351', '123456'],
            ['Yahya, S.H, M.H', '202352', '123456'],
            ['Yunik Rahmiyati, M.Pd', '202353', '123456'],
            ["Zahrotul Isti'anah Marroh, M.Pd", '202354', '123456'],
        ];

        foreach ($userData as $data) {
            $nama = $data[0];
            $nim = $data[1];

            $userId = DB::table('users')->insertGetId([
                'name' => $nama,
                'username' => $nim,
                'password' => Hash::make('123456')
            ]);

            DB::table('profiles')->insert([
                'user_id' => $userId,
                'joined_at' => now(),
            ]);

            DB::table('role_user')->insert([
                'role_id' => 4,
                'user_id' => $userId,
            ]);
        }
    }
}
