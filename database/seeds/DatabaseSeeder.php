<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        function autoIncrement()
        {
            for ($i = 0; $i < 1000; $i++) {
                yield $i;
            }
        }



        // $this->call(UsersTableSeeder::class);
        $this->call(TypeTableSeeder::class);
        $this->call(SubtypeTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
            //DB::table('activities')->truncate();
            DB::table('providers')->truncate();
            //DB::table('coupons')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
		
		//factory(\App\User::class, 30)->create();
        factory(\App\Coupon::class, 30)->create();
        //factory(\App\Place::class, 50)->create();
        factory(\App\Customer::class, 50)->create();
        factory(\App\Provider::class, 50)->create()
                        ->each(function($provider) {
                            $provider->subtypes()->sync(
                                App\Subtype::all()->random(3)
                            );
                        });
        //factory(\App\Activity::class, 200)->create();
        //factory(\App\Order::class, 50)->create();
        factory(\App\Banner::class, 100)->create();
        factory(\App\Account::class, 100)->create();
		
		DB::table('users')->insert([
		'name' => 'Teste',
        'email' => 'teste@teste.com',
        'password' => bcrypt('123456'), // secret
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
		]);
        
    }
}
