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

        // User::create([
        //     'name' => 'Fadlan Mulya Priatna',
        //     'username' => 'fadlan1',
        //     'role' => 2,
        //     'password' => bcrypt('12345')
        // ]);
        
        User::create([
            'name' => 'Admin',
            'username' => 'admin1',
            'role_id' => 1,
            'password' => bcrypt('12345')
        ]);
        User::factory(5)->create();

        Category::create([
            'name' => 'Announcement',
            'slug' => 'announcement'
        ]);
        
        Category::create([
            'name' => 'News',
            'slug' => 'News'
        ]);

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


        Post::factory(10)->create();
    }
}
