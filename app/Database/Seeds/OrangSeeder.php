<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class OrangSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        // $data = [
        //     'nama'      => 'Angga query builder',
        //     'alamat'    => 'JL. Gergaji Supeno',
        //     'created_at'=>  Time::now(),
        //     'update_at'=>  Time::now()
        // ];
            // copy data dari faker
            $faker = \Faker\Factory::create('id_ID');
            for ($i = 0; $i < 150; $i++) {
            $data = [
                'nama'      => $faker->name,
                'alamat'    => $faker->address,
                'created_at'=>  Time::createFromTimestamp($faker->unixTime()),
                'update_at'=>  Time::now()
        ];
        // Simple Queries
        // $this->db->query(
        //     "INSERT INTO orang (nama, alamat, created_at, update_at) VALUES(:nama:, :alamat:, :created_at:, :update_at:)", $data);

        //  Using Query Builder
         $this->db->table('orang')->insert($data);
            }
    }
}