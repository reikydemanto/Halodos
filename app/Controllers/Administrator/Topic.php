<?php

namespace App\Controllers\Administrator;

use App\Controllers\BaseController;
use App\Helpers\Datatables\Datatables;
use App\Models\Mstopic;

class Topic extends BaseController
{
    function __construct()
    {
        $this->topic = new Mstopic();
    }

    function index()
    {
        $data = [
            'title' => 'Data Topic'
        ];
        return view('topic/v_topic', $data);
    }

    function datatable()
    {
        $table = Datatables::method([Mstopic::class, 'getData'], 'searchable')
            ->make();
        $table->updateRow(function ($db, $no) {
            $tipe = 'master';
            if ($db->masterid != null) {
                $tipe = 'detail';
            }
            $btn_edit = "<a href=\"#\" class=\"btn btn-warning\" onclick=\"return modalForm('Update $db->topicname', '" . base_url('topic/form/' . $tipe . '/' . $db->topicid) . "')\"><i class=\"fas fa-edit\"></i></a>";
            $btn_hapus = "<a href=\"#\" class=\"btn btn-danger\" onclick=\"return modalHapus('Hapus topic $db->topicname', '$db->topicid', '" . base_url('topic/delete') . "', 'data_table')\"><i class=\"fas fa-trash\"></i></a>";
            return [
                $no,
                $db->topicname,
                $db->mastername,
                $db->prodiname,
                (($db->images != '') ? "<img src='" . base_url('public/img/topic/' . $db->images) . "' style='width: 40%;height: auto;'>" : ""),
                "$btn_edit $btn_hapus"
            ];
        });
        $table->toJson();
    }

    function forms($tipe, $id = '')
    {
        $view = 'topic/v_form';
        if ($tipe == 'detail') {
            $view = 'topic/v_form_detail';
        }
        $form_type = 'add';
        if ($id != '') {
            $form_type = 'edit';
        }
        $data = [
            'form_type' => $form_type,
            'row' => $this->topic->getOne($id),
            'tipe' => $tipe
        ];
        echo json_encode([
            'view' => view($view, $data)
        ]);
    }

    function addData()
    {
        $tipe = $this->getPost('tipe');
        $topicname = $this->getPost('topicname');
        $res = ['sukses' => 0];
        $data = [
            'topicname' => $topicname,
            'createdby' => session()->get('userid'),
            'updatedby' => session()->get('userid'),
            'createddate' => date('Y-m-d H:i:s'),
            'updateddate' => date('Y-m-d H:i:s'),
        ];
        if ($tipe == 'master') {
            $images = $this->request->getFile('images');
            $randname = $images->getRandomName();
            $images->move('public/img/topic', $randname);
            $prodiid = $this->request->getPost('prodiname');
            $data['prodiid'] = $prodiid;
            $data['images'] = $randname;
        } else {
            $masterid = $this->getPost('mastertopic');
            $getmaster = $this->topic->getOne($masterid);
            $prodiid = $getmaster['prodiid'];
            $data['prodiid'] = $prodiid;
            $data['masterid'] = $masterid;
        }
        $query = $this->topic->store($data);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function editData()
    {
        $id = $this->getPost('id');
        $tipe = $this->getPost('tipe');
        $topicname = $this->getPost('topicname');
        $res = ['sukses' => 0];
        $data = [
            'topicname' => $topicname,
            'updatedby' => session()->get('userid'),
            'updateddate' => date('Y-m-d H:i:s'),
        ];
        if ($tipe == 'master') {
            $images = $this->request->getFile('images');
            $randname = $this->getPost('old_images');
            if ($images != '') {
                $randname = $images->getRandomName();
                $images->move('public/img/topic', $randname);
            }
            $prodiid = $this->request->getPost('prodiname');
            $data['prodiid'] = $prodiid;
            $data['images'] = $randname;
        } else {
            $masterid = $this->getPost('mastertopic');
            $getmaster = $this->topic->getOne($masterid);
            $prodiid = $getmaster['prodiid'];
            $data['prodiid'] = $prodiid;
            $data['masterid'] = $masterid;
        }
        $query = $this->topic->edit($data, $id);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function deleteData()
    {
        $res = ['sukses' => 0];
        $id = $this->getPost('id');
        $query = $this->topic->destroy($id);
        if ($query) {
            $res['sukses'] = 1;
        }
        echo json_encode($res);
    }

    function getMaster($tipe = '')
    {
        $search = $this->getPost('searchTerm');
        $data = [];
        $get = $this->topic->getMaster($search);
        if ($tipe != '') {
            $dt = [
                'result' => $get
            ];
            echo json_encode($dt);
            die;
        }
        foreach ($get as $g) {
            $text = $g['topicname'];
            if (session()->get('role') == 'admin') {
                $text .= " ($g[prodiname])";
            }
            $data[] = array('id' => $g['topicid'], 'text' => $text);
        }
        echo json_encode($data);
    }

    function getSub()
    {
        $masterid = $this->getPost('masterid');
        $search = $this->getPost('searchTerm');
        $get = $this->topic->getSubs($masterid, $search);
        $data = [];
        foreach ($get as $g) {
            $text = $g['topicname'];
            $data[] = array('id' => $g['topicid'], 'text' => $text);
        }
        echo json_encode($data);
    }
}
