<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'student'],
            ['name' => 'reviewer'],
            ['name' => 'superadmin'],
        ]);

        DB::table('subjects')->insert([
            [
                'name' => 'Bahasa Arab',
                'slug' => 'bahasa-arab',
                'cover_path' => 'course-cover/QRGfgzkaZFy8XXAiagmCevfPBrsFPg-metaQXJhYmljLnN2Zw==-.svg',
            ],
            [
                'name' => 'Bahasa Inggris',
                'slug' => 'bahasa-inggris',
                'cover_path' => 'course-cover/mtFmnTzBBDsD5RY8oKFahvBtcK6qBh-metaRW5nbGlzaC5zdmc=-.svg',
            ],
        ]);

        DB::table('courses')->insert([
            [
                'subject_id' => 2,
                'name' => 'Bahasa Inggris Dasar',
                'slug' => 'bahasa-inggris-dasar',
                'cover_path' => 'course-cover/mtFmnTzBBDsD5RY8oKFahvBtcK6qBh-metaRW5nbGlzaC5zdmc=-.svg',
                'description' => '<p>Course Bahasa Inggris Dasar dirancang untuk membantu Anda memulai perjalanan belajar bahasa Inggris dengan percaya diri. Dalam kursus ini, Anda akan mengembangkan keterampilan dasar dalam berbicara, mendengarkan, membaca, dan menulis dalam bahasa Inggris. Dengan materi yang mudah dipahami dan latihan interaktif, Anda akan memperluas kosakata Anda, memahami struktur kalimat, dan meningkatkan kemampuan komunikasi sehari-hari Anda. Kursus ini cocok untuk pemula dan siapa pun yang ingin memperoleh dasar yang kokoh dalam bahasa Inggris.</p>',
            ],
            [
                'subject_id' => 1,
                'name' => 'Bahasa Arab Dasar',
                'slug' => 'bahasa-arab-dasar',
                'cover_path' => 'course-cover/QRGfgzkaZFy8XXAiagmCevfPBrsFPg-metaQXJhYmljLnN2Zw==-.svg',
                'description' => '<p>Course Bahasa Arab Dasar adalah kursus yang dirancang khusus untuk membantu pemula dalam memahami dan menguasai dasar-dasar Bahasa Arab. Dalam kursus ini, Anda akan memperoleh pemahaman tentang huruf, kosakata, kalimat sederhana, dan percakapan sehari-hari dalam Bahasa Arab. Melalui materi yang disajikan dengan cara yang interaktif dan mudah dipahami, Anda akan diarahkan untuk membangun fondasi yang kuat dalam berbicara, membaca, dan menulis Bahasa Arab. Dengan instruktur yang berpengalaman, Course Bahasa Arab Dasar akan membantu Anda meraih kemampuan dasar yang esensial untuk berkomunikasi dalam Bahasa Arab sehari-hari.</p>',
            ],
        ]);

        DB::table('modules')->insert([
            [
                'course_id' => 1,
                'title' => 'Level 1',
                'is_visible' => 1,
            ],
            [
                'course_id' => 1,
                'title' => 'Level 2',
                'is_visible' => 1,
            ],
            [
                'course_id' => 1,
                'title' => 'Level 3',
                'is_visible' => 1,
            ],
            [
                'course_id' => 2,
                'title' => 'Level 1',
                'is_visible' => 1,
            ],
            [
                'course_id' => 2,
                'title' => 'Level 2',
                'is_visible' => 1,
            ],
            [
                'course_id' => 2,
                'title' => 'Level 3',
                'is_visible' => 1,
            ],
        ]);

        DB::table('submodules')->insert([
            [
                'module_id' => 1,
                'title' => 'Pentingnya Belajar Bahasa Inggris',
                'list_sort' => 1,
                'is_visible' => 1,
            ],
            [
                'module_id' => 1,
                'title' => 'Alfabet dan Pengucapan',
                'list_sort' => 2,
                'is_visible' => 1,
            ],
            [
                'module_id' => 1,
                'title' => 'Penjelasan Angka dan Hari dalam Bahasa Inggris & penambahan text buar panjang',
                'list_sort' => 3,
                'is_visible' => 1,
            ],
            [
                'module_id' => 1,
                'title' => 'Mengenal Warna dalam Bahasa Inggris',
                'list_sort' => 4,
                'is_visible' => 1,
            ],
            [
                'module_id' => 2,
                'title' => 'Pengenalan Kosakata Dasar',
                'list_sort' => 1,
                'is_visible' => 1,
            ],
            [
                'module_id' => 3,
                'title' => 'Percakapan Sederhana',
                'list_sort' => 1,
                'is_visible' => 1,
            ],
            [
                'module_id' => 4,
                'title' => 'Kosakata Dasar',
                'list_sort' => 1,
                'is_visible' => 1,
            ],
        ]);

        DB::table('materials')->insert([
            [
                'submodule_id' => 1,
                'content' => '<h4><strong>Pengantar:</strong></h4><p>Dalam submodul ini, kita akan menjelaskan mengapa Bahasa Inggris memiliki peran yang sangat penting dalam konteks dunia global saat ini. Kami juga akan membahas bagaimana belajar Bahasa Inggris dapat memberikan manfaat yang signifikan dalam berbagai aspek kehidupan, seperti karier, studi, dan komunikasi internasional.</p><p><strong>Mengapa Bahasa Inggris Penting dalam Dunia Global:</strong>&nbsp;</p><p>Bahasa Inggris adalah salah satu bahasa paling dominan dan banyak digunakan di seluruh dunia. Ini bukan hanya bahasa asal negara-negara berbahasa Inggris, tetapi juga telah menjadi bahasa internasional untuk bisnis, ilmu pengetahuan, teknologi, seni, dan budaya. Karena itu, memiliki pemahaman yang baik tentang Bahasa Inggris memberikan akses ke dunia yang lebih luas dan beragam.</p><p><strong>Manfaat Belajar Bahasa Inggris untuk Karier:</strong></p><ul><li>Banyak perusahaan multinasional dan organisasi global menggunakan Bahasa Inggris sebagai bahasa komunikasi resmi. Kemampuan berbicara dan menulis dalam Bahasa Inggris dapat meningkatkan peluang untuk bekerja di perusahaan-perusahaan ini.</li><li>Banyak pekerjaan memerlukan keterampilan Bahasa Inggris, terutama dalam industri pariwisata, perhotelan, teknologi informasi, dan bisnis internasional.</li><li>Bahasa Inggris juga diperlukan untuk berkomunikasi dengan rekan kerja, klien, dan mitra bisnis dari berbagai negara.</li></ul><p><strong>Manfaat Belajar Bahasa Inggris untuk Studi:</strong></p><ul><li>Banyak universitas terkemuka di seluruh dunia menggunakan Bahasa Inggris sebagai bahasa pengantar dalam program-program studi mereka. Belajar Bahasa Inggris dapat membuka pintu untuk mengejar gelar di universitas-internasional ini.</li><li>Banyak sumber daya akademik dan jurnal ilmiah ditulis dalam Bahasa Inggris. Pemahaman Bahasa Inggris memudahkan akses dan pemahaman terhadap penelitian dan informasi terbaru.</li></ul><p><strong>Manfaat Belajar Bahasa Inggris untuk Komunikasi Internasional:</strong></p><ul><li>Bahasa Inggris adalah bahasa yang umum digunakan dalam komunikasi internasional, termasuk pertemuan diplomatik, konferensi global, dan forum internasional.</li><li>Mampu berbicara Bahasa Inggris memungkinkan seseorang untuk berinteraksi dengan orang dari berbagai budaya dan latar belakang, memperluas jaringan sosial dan profesional.</li></ul><p><strong>Kesimpulan:</strong> Dalam dunia yang semakin terhubung dan global, belajar Bahasa Inggris tidak hanya menjadi pilihan, tetapi juga menjadi kebutuhan. Kemampuan berbicara, membaca, dan menulis dalam Bahasa Inggris membuka peluang yang tak terbatas dalam berbagai aspek kehidupan, dari karier hingga komunikasi internasional. Dalam submodul berikutnya, kami akan membahas langkah-langkah praktis untuk memulai perjalanan belajar Bahasa Inggris.</p>',
            ],
            [
                'submodule_id' => 2,
                'content' => '<p><strong>Pengenalan alfabet Bahasa Inggris dan perbedaannya dengan alfabet Bahasa Indonesia</strong></p><p>Dalam submodul ini, Anda akan mempelajari tentang alfabet Bahasa Inggris dan memahami perbedaannya dengan alfabet Bahasa Indonesia. Alfabet adalah dasar dari setiap bahasa, dan memahami bagaimana huruf-huruf ini bekerja akan membantu Anda membangun fondasi yang kuat dalam belajar Bahasa Inggris.</p><ul><li>Pengenalan Alfabet Bahasa Inggris: Anda akan belajar mengenal dan menghafal 26 huruf dalam alfabet Bahasa Inggris beserta pengucapannya. Perbedaan dalam nama dan pengucapan huruf-huruf ini dibandingkan dengan alfabet Bahasa Indonesia juga akan dijelaskan.</li><li>Perbedaan Antara Alfabet Bahasa Inggris dan Bahasa Indonesia: Anda akan memahami perbedaan dalam susunan huruf-huruf dan pengucapan antara alfabet Bahasa Inggris dan Bahasa Indonesia. Ini akan membantu Anda menghindari kesalahan umum saat mengucapkan kata-kata dalam Bahasa Inggris.</li></ul><p><strong>Latihan pengucapan bunyi-bunyi dasar dalam Bahasa Inggris</strong></p><p>Pengucapan yang baik adalah kunci untuk berkomunikasi dengan lancar dalam Bahasa Inggris. Dalam bagian ini, Anda akan berlatih pengucapan beberapa bunyi dasar dalam Bahasa Inggris.</p><ul><li>Vokal dalam Bahasa Inggris: Anda akan belajar mengenali dan mengucapkan bunyi vokal dalam Bahasa Inggris seperti /iː/, /æ/, /ʌ/, dan lain-lain.</li><li>Konsonan dalam Bahasa Inggris: Anda akan berlatih mengucapkan beberapa konsonan seperti /b/, /d/, /k/, /f/, dan lainnya dengan benar.</li><li>Latihan Pengucapan: Anda akan diberikan kata-kata dan frasa yang berisi bunyi-bunyi yang sedang dipelajari. Anda akan berlatih mengucapkannya dengan benar dan mengoreksi diri sendiri.</li><li>Latihan Listening: Anda akan mendengarkan contoh-contoh pengucapan dan mencoba menirukannya. Ini akan membantu Anda memahami bagaimana bunyi-bunyi tersebut seharusnya terdengar.</li></ul><p>Dengan memahami alfabet dan menguasai pengucapan bunyi-bunyi dasar, Anda akan memiliki dasar yang kuat untuk berbicara dan memahami Bahasa Inggris dengan lebih baik. Terus berlatih dan Anda akan melihat peningkatan yang signifikan dalam kemampuan Anda!</p>',
            ],
            [
                'submodule_id' => 3,
                'content' => 'content',
            ],
            [
                'submodule_id' => 4,
                'content' => "content",
            ],
            [
                'submodule_id' => 5,
                'content' => "<h2><strong>Pengenalan Kosakata Dasar</strong></h2><p><strong>A. Kata Benda (Nouns)</strong></p><p>Kata benda adalah kata yang digunakan untuk merujuk pada orang, tempat, benda, atau konsep. Berikut adalah beberapa contoh kata benda dalam Bahasa Inggris:</p><ol><li><strong>Person (Orang):</strong> man (pria), woman (wanita), child (anak), teacher (guru)</li><li><strong>Place (Tempat):</strong> school (sekolah), park (taman), home (rumah), city (kota)</li><li><strong>Thing (Benda):</strong> car (mobil), book (buku), table (meja), phone (telepon)</li><li><strong>Idea (Konsep):</strong> love (cinta), happiness (kebahagiaan), knowledge (pengetahuan), freedom (kebebasan)</li></ol><p><strong>B. Kata Kerja (Verbs)</strong></p><p>Kata kerja adalah kata yang menggambarkan tindakan atau keadaan. Berikut adalah beberapa contoh kata kerja dalam Bahasa Inggris:</p><ol><li><strong>Action Verbs (Kata Kerja Tindakan):</strong> run (lari), eat (makan), read (membaca), dance (menari)</li><li><strong>State Verbs (Kata Kerja Keadaan):</strong> be (berada), like (suka), know (tahu), want (ingin)</li><li><strong>Modal Verbs (Kata Kerja Modal):</strong> can (bisa), must (harus), should (sebaiknya), will (akan)</li></ol><p><strong>C. Kata Sifat (Adjectives)</strong></p><p>Kata sifat adalah kata yang digunakan untuk menggambarkan atau menjelaskan kata benda. Berikut adalah beberapa contoh kata sifat dalam Bahasa Inggris:</p><ol><li><strong>Descriptive Adjectives (Kata Sifat Deskriptif):</strong> big (besar), beautiful (indah), happy (bahagia), intelligent (cerdas)</li><li><strong>Quantitative Adjectives (Kata Sifat Kuantitatif):</strong> few (sedikit), many (banyak), several (beberapa), all (semua)</li><li><strong>Opinion Adjectives (Kata Sifat Opini):</strong> good (baik), interesting (menarik), delicious (lezat), boring (membosankan)</li></ol><p><strong>D. Kata Keterangan (Adverbs)</strong></p><p>Kata keterangan adalah kata yang digunakan untuk menggambarkan atau menjelaskan kata kerja, kata sifat, atau kata keterangan lainnya. Berikut adalah beberapa contoh kata keterangan dalam Bahasa Inggris:</p><ol><li><strong>Manner Adverbs (Kata Keterangan Cara):</strong> quickly (dengan cepat), slowly (dengan lambat), well (dengan baik), badly (dengan buruk)</li><li><strong>Frequency Adverbs (Kata Keterangan Frekuensi):</strong> always (selalu), often (sering), sometimes (kadang-kadang), never (tidak pernah)</li><li><strong>Time Adverbs (Kata Keterangan Waktu):</strong> now (sekarang), yesterday (kemarin), today (hari ini), tomorrow (besok)</li></ol><p><strong>E. Kata Tanya (Question Words)</strong></p><p>Kata tanya digunakan untuk mengajukan pertanyaan. Berikut adalah beberapa contoh kata tanya dalam Bahasa Inggris:</p><ol><li><strong>Wh-Questions (Pertanyaan Wh-):</strong> what (apa), where (di mana), when (kapan), who (siapa), why (mengapa)</li><li><strong>Yes/No Questions (Pertanyaan Ya/Tidak):</strong> Is (Apakah), Are (Apakah), Do (Apakah), Can (Bisakah)</li></ol><p><strong>F. Kata Ganti (Pronouns)</strong></p><p>Kata ganti digunakan untuk menggantikan kata benda dalam kalimat. Berikut adalah beberapa contoh kata ganti dalam Bahasa Inggris:</p><ol><li><strong>Personal Pronouns (Kata Ganti Orang):</strong> I (saya), you (kamu/anda), he (dia laki-laki), she (dia perempuan), it (itu), we (kita), they (mereka)</li><li><strong>Possessive Pronouns (Kata Ganti Kepunyaan):</strong> mine (milik saya), yours (milikmu/milik Anda), his (miliknya laki-laki), hers (miliknya perempuan), its (miliknya), ours (milik kita), theirs (milik mereka)</li></ol><p><strong>G. Kata Hubung (Conjunctions)</strong></p><p>Kata hubung digunakan untuk menghubungkan kata-kata, frasa, atau klausa dalam kalimat. Berikut adalah beberapa contoh kata hubung dalam Bahasa</p>",
            ],
            [
                'submodule_id' => 6,
                'content' => "content",
            ],
            [
                'submodule_id' => 7,
                'content' => "content",
            ],
        ]);
    }
}
