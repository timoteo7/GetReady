<?php

use Illuminate\Database\Seeder;
use App\Subtype;
use Faker\Generator as Faker;

class SubtypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		$faker = \Faker\Factory::create();

        $categorias= ['Cabelo' => ['Corte com Escova', 'Corte Feminino' , 'Escova' , 'Escova Gloss', 'Hidratação Mascara de Cor', 'Hidratação Neutramix', 'Matização', 'Penteado', 'Progressiva', 'Reconstrução Capilar', 'Mechas' ] ,
						'Manicure/Pedicure' => ['Alongamento em Gel', 'Banho de Gel' , 'Mão Simples' , 'Pé Simples', 'Francesinha' , 'Esmaltação' , 'Unhas Postiças' ],
						'Estética Facial' => ['Design de Sobrancelha', 'Design sw Sobrancelha com Henna', 'Coloração de Cilios', 'Coloração de Sobrancelhas', 'Limpeza de pele', 'Permanente de Cilios', 'Botox Facial', ],
						'Estética Corporal' => ['Massagem Relaxante', 'Drenagem Linfática', 'Massagem Redutora'] , 
						'Depilação' => [  'Depilação Buço', 'Depilação Facial' , 'Sobrancelha', 'Queixo', 'Braço', 'Perna', 'Abdomen', 'Axilas', 'Costas Masculino', 'Gluteos', 'Virilia' ] , 
						'Barbearia' => [ 'Corte Masculino (Maquina)' , 'Corte Masculino' , 'Corte Masculino com Barba' ] ];
		
		$tablename=with(new Subtype)->getTable();
		$columns = Schema::getColumnListing($tablename);

		DB::statement('SET FOREIGN_KEY_CHECKS=0');
			DB::table($tablename)->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');

		$v1=0;
		foreach ($categorias as $type=>$subtypelist){
			$v1++;
			foreach ($subtypelist as $subtype)
			{
				$model[]=array(
					$columns[1] => $v1,
					$columns[2] => $subtype,
					$columns[3] => ($faker->numberBetween($min = 3, $max = 20)*10),
					$columns[4] => ($faker->numberBetween($min = 2, $max = 18)*5),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
					);
			}
		}

		for($v1=0;$v1<count($model);$v1++)
			DB::table($tablename)->insert($model[$v1]);
			
        //factory(\App\Subtype::class, 50)->create();
    }
}
