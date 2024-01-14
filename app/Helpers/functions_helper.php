<?php

use App\Models\Trkonsultasi;

function getListMenu()
{
    $role = session()->get('role');
    $arraymenu = [];
    if ($role == 'admin') {
        $arraymenu = [
            [
                'menuname' => 'Dashboard',
                'menulink' => 'beranda',
                'menuicon' => 'fas fa-fw fa-tachometer-alt',
            ],
            [
                'menuname' => 'Kampus',
                'menulink' => 'kampus',
                'menuicon' => 'fas fa-fw fa-university',
            ],
            [
                'menuname' => 'User',
                'menulink' => 'user',
                'menuicon' => 'fas fa-fw fa-users',
            ],
            [
                'menuname' => 'Prodi',
                'menulink' => 'prodi',
                'menuicon' => 'fas fa-fw fa-book',
            ],
            [
                'menuname' => 'Topic',
                'menulink' => 'topic',
                'menuicon' => 'fas fa-fw fa-lightbulb',
            ],
        ];
    } elseif ($role == 'dospem') {
        $arraymenu = [
            [
                'menuname' => 'Dashboard',
                'menulink' => 'beranda',
                'menuicon' => 'fas fa-fw fa-tachometer-alt',
            ],
            [
                'menuname' => 'Konsultasi',
                'menulink' => 'konsultasi',
                'menuicon' => 'fas fa-fw fa-chalkboard-teacher',
            ]
        ];
    } else {
        $arraymenu = [
            [
                'menuname' => 'Dashboard',
                'menulink' => 'beranda',
                'menuicon' => 'fas fa-fw fa-tachometer-alt',
            ],
            [
                'menuname' => 'Konsultasi',
                'menulink' => 'konsultasi',
                'menuicon' => 'fas fa-fw fa-chalkboard-teacher',
            ]
        ];
    }

    return $arraymenu;
}

function loadImgProfile()
{
    $role = session()->get('role');
    $jenkel = session()->get('jeniskelamin');
    if ($jenkel == '') {
        $jenkel = 'lakilaki';
    }
    if ($role == 'admin') {
        $role = 'user';
    }
    return "public/img/$role-$jenkel.png";
}

function emailKonsul($mails, $konsulid, $status)
{
    $email = \Config\Services::email();
    $konsul = new Trkonsultasi();
    $getKonsul = $konsul->getOne($konsulid);
    $role = session()->get('role');
    $text = session()->get('fullname') . ' menjadwalkan konsultasi bersama anda';
    if ($status == 'reject') {
        $text = 'Dosen Menolak Konsultasi';
    } else if ($status == 'insert') {
        $text = 'Dosen menerima jadwal konsultasi yang kamu ajukan';
    }

    $data = [
        'konsul' => $getKonsul,
        'text' => $text,
        'status' => $status,
        'role' => $role
    ];
    $email->setFrom('doflamingo9804@gmail.com', 'HaloDos');
    $email->setTo($mails);
    $email->setSubject($text);
    $email->setMessage(view('konsultasi/email_konsultasi', $data));
    $email->send();
    return $email->printDebugger();
}

function enkripsi_forgot($id)
{
    $enkripsi = \Config\Services::encrypter();
    return base64_encode(base64_encode($enkripsi->encrypt($id)));
}

function deskripsi_forgot($id)
{
    $enkripsi = \Config\Services::encrypter();
    return $enkripsi->decrypt(base64_decode(base64_decode($id)));
}
