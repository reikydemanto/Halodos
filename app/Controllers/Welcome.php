<?php

namespace App\Controllers;


class Welcome extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Welcome'
        ];
        return view('welcome/v_welcome', $data);
    }
}
