<?php

namespace App\Controllers;

class ProfilController 
{
    public function index()
    {
        echo 'Je suis la HomePage';
    }

    public function show(int $id)
    {
        echo 'Je suis le Profil ' . $id;
    }


}