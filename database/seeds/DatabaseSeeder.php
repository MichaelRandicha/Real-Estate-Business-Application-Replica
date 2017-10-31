<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AgentsTableSeeder::class);
        // DB::table('agents')->insert([
        //     'nama' => 'Perusahaan',
        //     'lokasi' => 'Surabaya',
        //     'telepon' => '123456789011',
        // ]);
    }
}
