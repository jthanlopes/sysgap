<?php

use Illuminate\Database\Seeder;

class ConhecimentoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('conhecimentos')->insert([
      'titulo' => 'Laravel 5.4',
      'descricao' => 'Back-end',
      'padrao' => 1,
      'created_at' => new \DateTime(),
      'updated_at' => new \DateTime(),
    ]);

     DB::table('conhecimentos')->insert([
      'titulo' => 'MySQL',
      'descricao' => 'BD',
      'padrao' => 1,
      'created_at' => new \DateTime(),
      'updated_at' => new \DateTime(),
    ]);

     DB::table('conhecimentos')->insert([
      'titulo' => 'HTML5',
      'descricao' => 'Front-end',
      'padrao' => 1,
      'created_at' => new \DateTime(),
      'updated_at' => new \DateTime(),
    ]);

     DB::table('conhecimentos')->insert([
      'titulo' => 'Workbench',
      'descricao' => 'Ferramenta',
      'padrao' => 1,
      'created_at' => new \DateTime(),
      'updated_at' => new \DateTime(),
    ]);

     DB::table('conhecimentos')->insert([
      'titulo' => 'Photoshop CC',
      'descricao' => 'Ferramenta',
      'padrao' => 1,
      'created_at' => new \DateTime(),
      'updated_at' => new \DateTime(),
    ]);
   }
 }
