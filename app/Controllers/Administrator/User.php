<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Msuser;

class User extends BaseController
{
    function __construct()
    {
        session()->set('userid', 1);
        $this->user = new Msuser();
    }

    function index()
    {
        $data = [
            'title' => 'Data User'
        ];
        return view('user/v_user', $data);
    }

    function datatable()
    {
        $table = Datatables::method([Msuser::class, 'getData'], 'searchable')
            ->make();
        $table->updateRow(function ($db, $no) {
            $btn_edit = "<a href=\"#\" class=\"btn btn-sm btn-warning\" onclick=\"return modalForm('Update $db->fullname', '" . base_url('user/form/' . $db->userid) . "')\"><i class=\"fas fa-edit\"></i></a>";
            $btn_hapus = "<a href=\"#\" class=\"btn btn-sm btn-danger\" onclick=\"return modalHapus('Hapus user $db->fullname', '$db->userid', '" . base_url('user/delete') . "', 'data_table')\"><i class=\"fas fa-trash\"></i></a>";
            return [
                $no,
                $db->fullname,
                $db->usercode,
                $db->email,
                $db->phonenumber,
                $db->kampusname,
                $db->prodiname,
                $db->role,
                "$btn_edit $btn_hapus"
            ];
        });
        $table->toJson();
    }

    function forms($id = '')
    {
        $form_type = 'add';
        if ($id != '') {
            $form_type = 'edit';
        }
        $data = [
            'form_type' => $form_type,
            'row' => $this->user->getOne($id)
        ];
        echo json_encode([
            'view' => view('user/v_form', $data),
        ]);
    }

    function addData()
    {
        $res = ['sukses' => 0];
        $fullname = $this->getPost('fullname');
        $email = $this->getPost('email');
        $code = $this->getPost('code');
        $checkemail = $this->user->checkEmail($email);
        if ($checkemail) {
            echo json_encode([
                'sukses' => 0,
                'msg' => 'Email sudah ada !'
            ]);
            die;
        }

        $phonenumber = $this->getPost('phonenumber');
        $kampusid = $this->getPost('namakampus');
        $jeniskelamin = $this->getPost('jeniskelamin');
        $prodiid = $this->getPost('prodiname');
        $role = $this->getPost('role');
        $password = $this->getPost('password');
        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'phonenumber' => $phonenumber,
            'kampusid' => $kampusid,
            'prodiid' => $prodiid,
            'role' => $role,
            'usercode' => $code,
            'jeniskelamin' => $jeniskelamin,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'createdby' => session()->get('userid'),
            'createddate' => date('Y-m-d H:i:s'),
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        $query = $this->user->store($data);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function editData()
    {
        $userid = $this->getPost('id');
        $fullname = $this->getPost('fullname');
        $email = $this->getPost('email');
        $code = $this->getPost('code');
        $old_email = $this->getPost('old-email');
        if ($email != $old_email) {
            $checkemail = $this->user->checkEmail($email);
            if ($checkemail) {
                echo json_encode([
                    'sukses' => 0,
                    'msg' => 'Email sudah ada !'
                ]);
                die;
            }
        }
        $phonenumber = $this->getPost('phonenumber');
        $kampusid = $this->getPost('namakampus');
        $prodiid = $this->getPost('prodiname');
        $role = $this->getPost('role');
        $password = $this->getPost('old-password');
        $jeniskelamin = $this->getPost('jeniskelamin');
        if ($this->getPost('password') != '') {
            $password = password_hash($this->getPost('password'), PASSWORD_DEFAULT);
        }
        $data = [
            'fullname' => $fullname,
            'email' => $email,
            'phonenumber' => $phonenumber,
            'kampusid' => $kampusid,
            'prodiid' => $prodiid,
            'jeniskelamin' => $jeniskelamin,
            'role' => $role,
            'usercode' => $code,
            'password' => $password,
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        $query = $this->user->edit($data, $userid);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function deleteData()
    {
        $res = ['sukses' => 0];
        $id = $this->getPost('id');
        $query = $this->user->destroy($id);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }
}
