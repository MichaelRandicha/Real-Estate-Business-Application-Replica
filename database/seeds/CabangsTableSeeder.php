<?php

use Illuminate\Database\Seeder;

class CabangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabangs')->insert([
        	'nama' => 'Cabang A',
        	'lokasi' => 'Surabaya',
        	'telepon' => '081237209954',
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        ]);
        DB::table('cabangs')->insert([
        	'nama' => 'Cabang B',
        	'lokasi' => 'Jakarta',
        	'telepon' => '081237209954',
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        ]);
        DB::table('cabangs')->insert([
        	'nama' => 'Cabang C',
        	'lokasi' => 'Malang',
        	'telepon' => '081237209954',
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        ]);
        DB::table('cabangs')->insert([
        	'nama' => 'Cabang D',
        	'lokasi' => 'Solo',
        	'telepon' => '081237209954',
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        ]);
        DB::table('cabangs')->insert([
        	'nama' => 'Cabang E',
        	'lokasi' => 'Jojga',
        	'telepon' => '081237209954',
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        ]);
        DB::table('cabangs')->insert([
        	'nama' => 'Cabang F',
        	'lokasi' => 'Bali',
        	'telepon' => '081237209954',
        	'created_at' => new DateTime,
        	'updated_at' => new DateTime,
        ]);
    }
}
