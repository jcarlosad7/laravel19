<?php

use Illuminate\Database\Seeder;

class EntradasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Entrada::class)->times(300)->create();
    }
}
