<?php

namespace App\Controllers;

use App\Models\Mstopic;
use App\Models\Msuser;
use App\Models\Trkonsultasi;

class Konsultasi extends BaseController
{
    function __construct()
    {
        $this->user = new Msuser;
        $this->topic = new Mstopic;
        $this->konsul = new Trkonsultasi;
    }
    public function index()
    {
        $data = [
            'title' => 'Konsultasi',
            'konsul' => $this->konsul->getKonsul()
        ];
        return view('konsultasi/v_konsultasi', $data);
    }

    function loadDospem()
    {
        $topicid = $this->request->getGet('topicid');
        $subtopicid = $this->request->getGet('subtopicid');
        if ($topicid == null || $subtopicid == '') {
            return redirect()->to(base_url('konsultasi'));
        }
        $data = [
            'topic' => $this->topic->getOne($topicid),
            'subtopicid' => $subtopicid,
            'topicid' => $topicid,
            'title' => 'Pilih Dosen',
            'dosen' => $this->user->getDosen(session()->get('prodiid'))
        ];

        return view('konsultasi/v_pilihdosen', $data);
    }

    function formKonsul()
    {
        $topicid = $this->request->getGet('topicid');
        $subtopicid = $this->request->getGet('subtopicid');
        $dosenid = $this->request->getGet('dosenid');
        if ($dosenid == null || $dosenid == '') {
            return redirect()->to(base_url('konsultasi'));
        }
        $data = [
            'topic' => $this->topic->getOne($topicid),
            'subtopic' => $this->topic->getOne($subtopicid),
            'dosen' => $this->user->getOne($dosenid),
            'title' => 'Form Konsultasi'
        ];
        return view('konsultasi/form_konsultasi', $data);
    }

    function processAdd()
    {
        $res = ['sukses' => 0];
        $tanggal = $this->getPost('tanggal');
        $jamfrom = $this->getPost('fromwaktu');
        $jamto = $this->getPost('towaktu');
        $topicid = $this->getPost('topicid');
        $topicdtid = $this->getPost('subtopicid');
        $dosenid = $this->getPost('dosenid');
        $getdosen = $this->user->getOne($dosenid);
        $tgl_from = date('Y-m-d H:i:s', strtotime($tanggal . ' ' . $jamfrom));
        $tgl_to = date('Y-m-d H:i:s', strtotime($tanggal . ' ' . $jamto));
        $var = date_diff(date_create($tgl_from), date_create($tgl_to));
        if ($var->h > 2) {
            $res['msg'] = 'Waktu tidak boleh lebih dari 2 jam';
            echo json_encode($res);
            die;
        }
        $data = [
            'kampusid' => session()->get('kampusid'),
            'prodiid' => session()->get('prodiid'),
            'topicid' => $topicid,
            'topicdtid' => $topicdtid,
            'dosenid' => $dosenid,
            'userid' => session()->get('userid'),
            'tanggal' => $tanggal,
            'jamfrom' => $jamfrom,
            'jamto' => $jamto,
            'status' => 'pending',
            'link' => '#'
        ];
        $query = $this->konsul->store($data);
        if ($query) {
            $insertid = db_connect()->insertID();
            emailKonsul($getdosen['email'], $insertid, 'pending');
            $res = ['sukses' => 1];
        }
        echo json_encode($res);
    }

    function form_schedule($konsulid)
    {
        $data = [
            'konsul' => $this->konsul->getOne($konsulid)
        ];
        echo json_encode([
            'view' => view('konsultasi/form_jadwal', $data)
        ]);
    }

    function form_reject($konsulid)
    {
        $data = [
            'konsul' => $this->konsul->getOne($konsulid)
        ];
        echo json_encode([
            'view' => view('konsultasi/form_reject', $data)
        ]);
    }

    function addJadwal()
    {
        $id = $this->getPost('konsulid');
        $link = $this->getPost('links');
        $getuser = $this->konsul->getOne($id);
        $data = [
            'link' => $link,
            'status' => 'insert'
        ];
        $query = $this->konsul->edit($data, $id);
        $res = ['sukses' => 0];
        if ($query) {
            $res['sukses'] = 1;
            emailKonsul($getuser['user_mail'], $id, 'insert');
        }
        echo json_encode($res);
    }

    function rejectJadwal()
    {
    $id = $this->getPost('konsulid');
        $reason = $this->getPost('reason');
        $getuser = $this->konsul->getOne($id);
        $data = [
            'reason' => $reason,
            'status' => 'reject'
        ];
        $query = $this->konsul->edit($data, $id);
        $res = ['sukses' => 0];
        if ($query) {
            $res['sukses'] = 1;
            emailKonsul($getuser['user_mail'], $id, 'reject');
        }
        echo json_encode($res);
    }
}
