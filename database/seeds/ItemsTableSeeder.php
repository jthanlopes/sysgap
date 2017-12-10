<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('items')->insert([
        'pergunta' => 'Pontualidade',
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('items')->insert([
       'pergunta' => 'Conhecimentos',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Trabalho em equipe',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Remuneração e benefícios',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Ambiente de trabalho',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Oportunidade de crescimento',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);
    }
  }
