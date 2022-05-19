<?php

namespace App\Controllers;

class Halaman extends BaseController
{
    public function index()
    {
        $faker = \Faker\Factory::create();
        $data = [
            'title'=> 'Home ||| home'
        ];
       // echo "Hello Ini Halamana Web"; 
       // echo view('layout/header',$data);
        return view('pages/home',$data);
       // echo view('layout/footer');

    }

    public function tentang()
    {
        $data = [
            'title'=> 'Tentang'
        ];
        // echo view('layout/header',$data);
        return view('pages/tentang',$data);
        // echo view('layout/footer');

    }

    public function kontak()
    {
        $data = [
            'title'=> 'Kontak'
        ];
        // echo view('layout/header',$data);
        return view('pages/kontak',$data);
        // echo view('layout/footer');

    }
}
