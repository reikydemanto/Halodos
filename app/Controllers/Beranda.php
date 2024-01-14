<?php

namespace App\Controllers;

use App\Models\Msuser;
use App\Models\Trkonsultasi;

class Beranda extends BaseController
{
    function __construct()
    {
        $this->konsul = new Trkonsultasi();
        $this->user = new Msuser();
    }
    public function index()
    {
        $konsul = [];
        if (session()->get('role') == 'dospem') {
            $konsul = $this->konsul->getKonsul();
        }
        $data = [
            'title' => 'Dashboard',
            'row' => $this->user->getOne(session()->get('userid')),
            'konsul' => $konsul
        ];
        return view('v_dashboard', $data);
    }
}
