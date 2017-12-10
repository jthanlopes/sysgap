<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Admin::class, 1)->create();

      DB::table('admins')->insert([
        'name' => 'Angelo Luz',
        'email' => 'angelo@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => 'angelo.jpg',
        'active' => 1,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime()
      ]);

      DB::table('admins')->insert([
        'name' => 'Jonathan Lopes',
        'email' => 'jthan.lopes@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => 'jonathan.jpg',
        'active' => 1,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime()
      ]);

      DB::table('admins')->insert([
        'name' => 'Carlos Vinícius',
        'email' => 'cv@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => 'cv.jpg',
        'active' => 1,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime()
      ]);

      DB::table('admins')->insert([
        'name' => 'Edécio Fernando',
        'email' => 'edecio@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => 'edecio.jpg',
        'active' => 1,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime()
      ]);

      DB::table('admins')->insert([
        'name' => 'Gladimir Ceroni',
        'email' => 'gladimir@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => 'gladimir.jpg',
        'active' => 1,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime()
      ]);

      DB::table('admins')->insert([
        'name' => 'Paulo Roberto Luzzardi',
        'email' => 'luzzardi@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => 'luzzardi.jpg',
        'active' => 1,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime()
      ]);

    }
  }
