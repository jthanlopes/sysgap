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
        'destino' => 'Empresas',
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('items')->insert([
       'pergunta' => 'Conhecimentos',
       'destino' => 'Empresas',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Trabalho em equipe',
       'destino' => 'Empresas',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Remuneração e benefícios',
       'destino' => 'Freelancers',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Ambiente de trabalho',
       'destino' => 'Freelancers',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);

      DB::table('items')->insert([
       'pergunta' => 'Oportunidade de crescimento',
       'destino' => 'Freelancers',
       'created_at' => new \DateTime(),
       'updated_at' => new \DateTime(),
     ]);
    }
  }
