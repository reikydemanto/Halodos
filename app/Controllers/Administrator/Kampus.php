<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Mskampus;
use App\Models\Mskampusprodi;
use App\Models\Msprodi;

class Kampus extends BaseController
{
    function __construct()
    {
        $this->kampus = new Mskampus();
        $this->kajur = new Mskampusprodi();
        $this->prodi = new Msprodi();
    }

    function index()
    {
        $data = [
            'title' => 'Data Kampus'
        ];
        return view('kampus/v_kampus', $data);
    }

    function datatable()
    {
        $table = Datatables::method([Mskampus::class, 'getData'], 'searchable')
            ->make();
        $table->updateRow(function ($db, $no) {
            $btn_edit = "<a href=\"#\" class=\"btn btn-warning\" onclick=\"return modalForm('Update $db->kampusname', '" . base_url('kampus/form/' . $db->kampusid) . "')\"><i class=\"fas fa-edit\"></i></a>";
            $btn_akses = "<a href=\"#\" class=\"btn btn-success\" onclick=\"return modalForm('Atur Prodi $db->kampusname', '" . base_url('kampus/form_prodi/' . $db->kampusid) . "')\"><i class=\"fas fa-book-open\"></i></a>";
            $btn_hapus = "<a href=\"#\" class=\"btn btn-danger\" onclick=\"return modalHapus('Hapus kampus $db->kampusname', '$db->kampusid', '" . base_url('kampus/delete') . "', 'data_table')\"><i class=\"fas fa-trash\"></i></a>";
            return [
                $no,
                $db->kampusname,
                $db->kampusaddress,
                "$btn_edit $btn_akses $btn_hapus"
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
            'row' => $this->kampus->getOne($id)
        ];
        echo json_encode([
            'view' => view('kampus/v_form', $data)
        ]);
    }

    function form_prodi($id)
    {
        $data = [
            'row' => $this->kampus->getOne($id),
        ];
        echo json_encode([
            'view' => view('kampus/v_form_prodi', $data)
        ]);
    }

    function loadProdi()
    {
        $kampusid = $this->getPost('kampusid');
        $gets = $this->prodi->getData()->get()->getResultArray();
        $data = [];
        foreach ($gets as $g) {
            $checked = 'f';
            $valid = $this->kajur->checkKampusProdi($kampusid, $g['prodiid']);
            if ($valid) {
                $checked = 't';
            }
            array_push($data, [
                'prodiid' => $g['prodiid'],
                'prodicode' => $g['prodicode'],
                'prodiname' => $g['prodiname'],
                'checked' => $checked
            ]);
        }
        echo json_encode([
            'result' => $data
        ]);
    }

    function addData()
    {
        $res = ['sukses' => 0];
        $kampusname = $this->getPost('namakampus');
        $kampusaddress = $this->getPost('alamatkampus');
        $data = [
            'kampusname' => $kampusname,
            'kampusaddress' => $kampusaddress,
            'createdby' => session()->get('userid'),
            'createddate' => date('Y-m-d H:i:s'),
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        $query = $this->kampus->store($data);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function editData()
    {
        $res = ['sukses' => 0];
        $kampusid = $this->getPost('id');
        $kampusname = $this->getPost('namakampus');
        $kampusaddress = $this->getPost('alamatkampus');
        $data = [
            'kampusname' => $kampusname,
            'kampusaddress' => $kampusaddress,
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        $query = $this->kampus->edit($data, $kampusid);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function deleteData()
    {
        $res = ['sukses' => 0];
        $id = $this->getPost('id');
        $query = $this->kampus->destroy($id);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function getKampus()
    {
        $search = $this->getPost('searchTerm');
        $data = [];
        $get = $this->kampus->getSelect($search);
        foreach ($get as $g) {
            $data[] = array('id' => $g['kampusid'], 'text' => $g['kampusname']);
        }
        echo json_encode($data);
    }

    function processAccess()
    {
        $kampusid = $this->getPost('kampusid');
        $checked = $this->getPost('checked');
        $prodiid = $this->getPost('prodiid');
        if ($checked == 't') {
            $data = [
                'kampusid' => $kampusid,
                'prodiid' => $prodiid
            ];
            $this->kajur->store($data);
        } else {
            $gets = $this->kajur->checkKampusProdi($kampusid, $prodiid);
            $kpid = $gets['kpid'];
            $this->kajur->destroy($kpid);
        }
        echo json_encode([
            'result' => 1
        ]);
    }
}
