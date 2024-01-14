<?php

namespace App\Controllers;

class akun extends BaseController
{
    public function index(){
		$data = [
			'title' => 'akun',
			'view' => 'akun/akun',

		];
		echo view('akun/akun1', $data);
	}
}
