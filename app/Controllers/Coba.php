<?php

namespace App\Controllers;

class Coba extends BaseController
{
    public function index()
    {
        //return view('welcome_message');
       echo "ini kontroler coba";
    }
   
public function about()
{
    echo "about siapa, nama saya $this->nama.";

}
}
