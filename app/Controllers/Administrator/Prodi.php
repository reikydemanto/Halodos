<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Mskampusprodi;
use App\Models\Msprodi;

class Prodi extends BaseController
{
    function __construct()
    {
        $this->prodi = new Msprodi();
        $this->kajur = new Mskampusprodi();
    }

    function index()
    {
        $data = [
            'title' => 'Data Prodi'
        ];
        return view('prodi/v_prodi', $data);
    }

    function datatable()
    {
        $table = Datatables::method([Msprodi::class, 'getData'], 'searchable')
            ->make();
        $table->updateRow(function ($db, $no) {
            $btn_edit = "<a href=\"#\" class=\"btn btn-warning\" onclick=\"return modalForm('Update $db->prodiname', '" . base_url('prodi/form/' . $db->prodiid) . "')\"><i class=\"fas fa-edit\"></i></a>";
            $btn_hapus = "<a href=\"#\" class=\"btn btn-danger\" onclick=\"return modalHapus('Hapus prodi $db->prodiname', '$db->prodiid', '" . base_url('prodi/delete') . "', 'data_table')\"><i class=\"fas fa-trash\"></i></a>";
            return [
                $no,
                $db->prodicode,
                $db->prodiname,
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
            'row' => $this->prodi->getOne($id)
        ];

        echo json_encode([
            'view' => view('prodi/v_form', $data)
        ]);
    }

    function addData()
    {
        $res = ['sukses' => 0];
        $prodiname = $this->getPost('namaprodi');
        $prodicode = $this->getPost('prodicode');
        $data = [
            'prodiname' => $prodiname,
            'prodicode' => $prodicode,
            'createdby' => session()->get('userid'),
            'createddate' => date('Y-m-d H:i:s'),
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        $query = $this->prodi->store($data);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function editData()
    {
        $res = ['sukses' => 0];
        $prodiid = $this->getPost('id');
        $prodiname = $this->getPost('namaprodi');
        $prodicode = $this->getPost('prodicode');
        $data = [
            'prodiname' => $prodiname,
            'prodicode' => $prodicode,
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s')
        ];
        $query = $this->prodi->edit($data, $prodiid);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function deleteData()
    {
        $res = ['sukses' => 0];
        $id = $this->getPost('id');
        $query = $this->prodi->destroy($id);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function getProdi()
    {
        $search = $this->getPost('searchTerm');
        $kampusid = $this->getPost('kampusid');
        $data = [];
        $get = $this->kajur->getProdiByKampus($kampusid, $search);
        foreach ($get as $g) {
            $data[] = array('id' => $g['prodiid'], 'text' => $g['prodicode'] . ' - ' . $g['prodiname']);
        }
        echo json_encode($data);
    }

    function getAllProdi()
    {
        $search = $this->getPost('searchTerm');
        $data = [];
        $get = $this->prodi->getProdi($search);
        foreach ($get as $g) {
            $data[] = array('id' => $g['prodiid'], 'text' => $g['prodicode'] . ' - ' . $g['prodiname']);
        }
        echo json_encode($data);
    }
}
