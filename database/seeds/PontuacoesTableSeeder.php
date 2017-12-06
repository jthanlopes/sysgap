<?php

use Illuminate\Database\Seeder;

class PontuacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pontuacoes')->insert([
        'descricao' => 'Cadastro no site',
        'valor' => 100,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Confirmação de conta',
        'valor' => 100,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Envie uma mensagem ao administrador',
        'valor' => 100,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Faça alguma postagem',
        'valor' => 100,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Adicione algum conhecimento',
        'valor' => 150,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Adicione algum portfólio',
        'valor' => 150,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Crie seu primeiro projeto',
        'valor' => 200,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Crie seu primeiro job',
        'valor' => 200,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);

      DB::table('pontuacoes')->insert([
        'descricao' => 'Avaliações recebidas (50 x média da avaliação recebida)',
        'valor' => 50,
        'created_at' => new \DateTime(),
        'updated_at' => new \DateTime(),
      ]);
    }
  }
