<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Berita;
use App\Models\Kitab;
use App\Models\Post;
use App\Models\Rumpun;
use App\Models\Role;
use App\Models\Santri;
use App\Models\Ustad;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        

        // User uji coba
        User::create([
            'name' => 'Admin',
            'username' => 'admin1',
            'role_id' => 1,
            'password' => bcrypt('12345')
        ]);
        // User::create([
        //     'name' => 'Ustad',
        //     'username' => 'ustad1',
        //     'role_id' => 2,
        //     'password' => bcrypt('12345')
        // ]);
        // User::create([
        //     'name' => 'Santri',
        //     'username' => 'santri',
        //     'role_id' => 3,
        //     'password' => bcrypt('12345')
        // ]);
        // // User::factory(5)->create();

        // Ustad uji coba
        // Ustad::create([
        //     'user_id' => '2',
        //     'name' => 'ustad',
        //     'jk' => 'laki-laki',
        //     'no_kontak' => '081234567890'
        // ]);

        // Santri uji coba
        // Santri::create([
        //     'user_id' => '3',
        //     'name' => 'santri',
        //     'jk' => 'laki-laki',
        //     'no_induk' => '2022.01.001'
        // ]);

        //kategori postingan
        Category::create([
            'name' => 'Announcement',
            'slug' => 'announcement'
        ]);
        Category::create([
            'name' => 'News',
            'slug' => 'News'
        ]);

        //rumpun kitab
        Rumpun::create([
            'name' => 'Nahwu',
            'slug' => 'nahwu'
        ]);
        Rumpun::create([
            'name' => 'Shorof',
            'slug' => 'shorof'
        ]);
        Rumpun::create([
            'name' => 'Fiqih',
            'slug' => 'fiqih'
        ]);
        Rumpun::create([
            'name' => 'Tauhid',
            'slug' => 'tauhid'
        ]);
        Rumpun::create([
            'name' => 'Akhlaq',
            'slug' => 'akhlaq'
        ]);
        Rumpun::create([
            'name' => 'Hadits',
            'slug' => 'hadits'
        ]);
        Rumpun::create([
            'name' => 'Tarikh Islam',
            'slug' => 'tarikh-islam'
        ]);
        Rumpun::create([
            'name' => 'Ulumul Quran',
            'slug' => 'ulumul-quran'
        ]);
        Rumpun::create([
            'name' => 'Tafsir Quran',
            'slug' => 'tafsir-quran'
        ]);

        //role user
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin'
        ]);
        Role::create([
            'name' => 'Ustad',
            'slug' => 'ustad'
        ]);
        Role::create([
            'name' => 'Santri',
            'slug' => 'santri'
        ]);

        //contoh postingan
        // Post::factory(20)->create();

        //contoh kitab
        Kitab::create([
            'rumpun_id' => '1',
            'title' => 'Mukhtasor Ziddan',
            'slug' => 'mukhtasor-ziddan',
            'pengarang' => 'Abu Abdillah Muhammad bin Daud Ash-Shonhaji'
        ]);
        Kitab::create([
            'rumpun_id' => '1',
            'title' => 'Sirojul Murid ala Jurumiah fi Qowaidil Arobiyah',
            'slug' => 'sirojul-murid-ala-jurumiah-fi-qowaidil-arobiyah',
            'pengarang' => 'KH. Saefudin Zuhri'
        ]);
        Kitab::create([
            'rumpun_id' => '1',
            'title' => 'Imrithi',
            'slug' => 'imrithi',
            'pengarang' => 'Imam Ibrahim Al Bajuri'
        ]);
        Kitab::create([
            'rumpun_id' => '1',
            'title' => 'Alfiyyah Ibnu Malik',
            'slug' => 'alfiyyah-ibnu-malik',
            'pengarang' => "Muhammad bin Abdullah bin Malik ath-Tha'i al-Jayyani"
        ]);
        Kitab::create([
            'rumpun_id' => '2',
            'title' => 'Al-Kaelani',
            'slug' => 'al-kaelani',
            'pengarang' => 'Abul Hasan Ali Bin Hisyam Al Kailani'
        ]);
        Kitab::create([
            'rumpun_id' => '2',
            'title' => 'Tashrifan Haur Kuning',
            'slug' => 'tashrifan-haur-kuning',
            'pengarang' => "Muhammad Rif’at"
        ]);
        Kitab::create([
            'rumpun_id' => '2',
            'title' => 'Qiyas Bina',
            'slug' => 'qiyas-bina',
            'pengarang' => "Muhammad Rif’at"
        ]);
        Kitab::create([
            'rumpun_id' => '2',
            'title' => 'Nadm Al-Maqsud',
            'slug' => 'nadm-al-maqsud',
            'pengarang' => 'Syekh Muhammad Ilyas'
        ]);
        Kitab::create([
            'rumpun_id' => '3',
            'title' => 'Safinatun Najah',
            'slug' => 'safinatun-najah',
            'pengarang' => 'Salim Ibn Sumair Al-Hadrami'
        ]);
        Kitab::create([
            'rumpun_id' => '3',
            'title' => 'Sulam Al-Munajat',
            'slug' => 'sulam-al-munajat',
            'pengarang' => 'Syaikh Muhammad Umar Anawawi Al Bantani'
        ]);
        Kitab::create([
            'rumpun_id' => '3',
            'title' => 'Riyad Al-Badiah',
            'slug' => 'riyad-al-badiah',
            'pengarang' => 'Syaikh Muhammad Umar Anawawi Al Bantani'
        ]);
        Kitab::create([
            'rumpun_id' => '3',
            'title' => 'Taqrib',
            'slug' => 'taqrib',
            'pengarang' => 'Abu Suja'
        ]);
        Kitab::create([
            'rumpun_id' => '3',
            'title' => 'Fathul Qorib',
            'slug' => 'fathul-qorib',
            'pengarang' => 'Syamsuddin Abu Abdillah Muhammad Bin Qasim Al Ghazi'
        ]);
        Kitab::create([
            'rumpun_id' => '3',
            'title' => 'Al-Muqoddimah Al-Hadromiyyah Fiqh As-Syafiiyyah',
            'slug' => 'al-muqoddimah-al-hadromiyyah-fiqh-as-syafiiyyah',
            'pengarang' => "Syaikh Hadromy as-Syafi'i"
        ]);
        Kitab::create([
            'rumpun_id' => '4',
            'title' => 'Tijan Addaruri',
            'slug' => 'tijan-addaruri',
            'pengarang' => 'Syaikh Ibrahim Muhammad Bin Ahmad Al Bajuri'
        ]);
        Kitab::create([
            'rumpun_id' => '4',
            'title' => 'Syarh Tijan Addaruri',
            'slug' => 'syarh-tijan-addaruri',
            'pengarang' => 'Syekh Muhammad Nawawi Bin Umar Al-Jawi Al-Bantani'
        ]);
        Kitab::create([
            'rumpun_id' => '5',
            'title' => "Ta’limul Muta’allim",
            'slug' => 'ta-limul-muta-allim',
            'pengarang' => 'Syekh Az-Zarnuji'
        ]);
        Kitab::create([
            'rumpun_id' => '5',
            'title' => 'Akhlaq Al-Banin',
            'slug' => 'akhlaq-al-banin',
            'pengarang' => 'Syeikh Umar Bin Ahmad Baradja'
        ]);
        Kitab::create([
            'rumpun_id' => '5',
            'title' => 'Ayyuhal Walad',
            'slug' => 'ayyuhal-walad',
            'pengarang' => 'Imam Al Ghazaliy'
        ]);
        Kitab::create([
            'rumpun_id' => '5',
            'title' => 'Sullam At-Taufiq',
            'slug' => 'sullam-at-taufiq',
            'pengarang' => 'Syaikh Sayyid Abdullah Bin Husain Bin Thahir'
        ]);
        Kitab::create([
            'rumpun_id' => '6',
            'title' => 'Hadist Al-Arbain Nawawi',
            'slug' => 'hadist-al-arbain-nawawi',
            'pengarang' => 'Al-Imam Al-Allamah Abu Zakaria Yahya Bin Syaraf An-Nawawi Ad-Dimasyqi'
        ]);
        Kitab::create([
            'rumpun_id' => '6',
            'title' => 'Mukhtar Al-Hadist',
            'slug' => 'mukhtar-al-hadist',
            'pengarang' => 'Sayyid Ahmad Al-Hasyimi'
        ]);
        Kitab::create([
            'rumpun_id' => '7',
            'title' => 'Khulasoh Nurul Yaqin',
            'slug' => 'khulasoh-nurul-yaqin',
            'pengarang' => 'Umar Abdul Jabbar'
        ]);
        Kitab::create([
            'rumpun_id' => '8',
            'title' => "Tajwidul Qur'an",
            'slug' => 'tajwidul-qur-an',
            'pengarang' => 'KH Choer Affandi'
        ]);
    }
}
