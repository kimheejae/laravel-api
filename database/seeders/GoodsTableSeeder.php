<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Good;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Good::truncate();

        $faker = \Faker\Factory::create();

        for($i = 0; $i < 10; $i++){
            Good::create([
                'goods_no' => $faker->numberBetween(10, 500),
                'goods_nm' => $faker->sentence(1),
                'goods_cont' => 'test',
                'com_id' => 'testtest',
                'reg_dm' => date("Y-m-d H:i:s"),
                'upd_dm' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
