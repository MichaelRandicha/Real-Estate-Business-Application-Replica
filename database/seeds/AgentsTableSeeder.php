<?php

use Illuminate\Database\Seeder;

class AgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agents')->insert([
            'nama' => 'Perusahaan',
            'lokasi' => 'Surabaya',
            'telepon' => '123456789011',
        ]);
    }
}
