<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employeers')->insert([
            'name' => 'Almoxarifado',
            'identification_number' => '00.000.000-0',
            'document_number' => '000.000.000-00',
            'email' => 'almoxarifado@intergalaxy.dev',
            'address' => 'R. Dep. Heitor Alencar Furtado, 3350 - Mossunguê, Curitiba - PR, 81200-528',
            'phone' => '3333-3333',
            'function' => 'Almoxarifado',
        ]);
    }
}
