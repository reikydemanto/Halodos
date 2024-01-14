<?php

namespace App\Controllers\profile;

use App\Controllers\BaseController;
use App\Models\Msuser;

class Profile extends BaseController
{
    function __construct()
    {
        $this->user = new Msuser();
    }

    function index()
    {
        $data = [
            'row' => $this->user->getOne(session()->get('userid')),
            'title' => 'Profile'
        ];
        return view('profile/v_profile', $data);
    }

    function processEdit()
    {
        $res = ['sukses' => 0];
        $userid = $this->getPost('id');
        $fullname = $this->getPost('fullname');
        $kampusid = $this->getPost('namakampus');
        $jeniskelamin = $this->getPost('jeniskelamin');
        $prodiid = $this->getPost('prodiname');
        $email = $this->getPost('email');
        $email_lama = $this->getPost('email_lama');
        $password = $this->getPost('password');
        $konfir_password = $this->getPost('konfir_password');
        if ($email != $email_lama) {
            $checkemail = $this->user->checkEmail($email);
            if ($checkemail) {
                echo json_encode([
                    'sukses' => 0,
                    'msg' => 'Email sudah ada !'
                ]);
                die;
            }
        }

        $phonenumber = $this->getPost('phone');
        $data = [
            'fullname' => $fullname,
            'kampusid' => $kampusid,
            'jeniskelamin' => $jeniskelamin,
            'prodiid' => $prodiid,
            'email' => $email,
            'phonenumber' => $phonenumber,
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        if ($password != '') {
            if ($password != $konfir_password) {
                echo json_encode([
                    'sukses' => 0,
                    'msg' => 'Password tidak sama !'
                ]);
                die;
            } else {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        $query = $this->user->edit($data, $userid);
        if ($query) {
            $res['sukses'] = 1;
            session()->set('fullname', $fullname);
            session()->set('userid', $userid);
            session()->set('kampusid', $kampusid);
            session()->set('jeniskelamin', $jeniskelamin);
            session()->set('prodiid', $prodiid);
        }
        echo json_encode($res);
    }
}
