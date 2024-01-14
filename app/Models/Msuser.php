<?php

namespace App\Models;

use CodeIgniter\Model;

class Msuser extends Model
{
    protected $table = 'msuser us';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            'us.fullname',
            'us.email',
            'us.phonenumber',
            'k.kampusname',
            'p.prodiname',
            'us.role',
            null
        ];
    }

    function getData()
    {
        return $this->builder->select('us.userid, us.usercode, us.fullname, us.email, us.password, us.phonenumber, us.role, k.kampusid, k.kampusname, p.prodiid, p.prodiname, p.prodicode, us.jeniskelamin')
            ->join('mskampus k', 'k.kampusid=us.kampusid', 'left')
            ->join('msprodi p', 'p.prodiid=us.prodiid', 'left');
    }

    function getOne($id = '')
    {
        $x = $this->builder->select('us.userid, us.usercode, us.fullname, us.email, us.password, us.phonenumber, us.role, k.kampusid, k.kampusname, p.prodiid, p.prodiname, p.prodicode, us.jeniskelamin')
            ->join('mskampus k', 'k.kampusid=us.kampusid', 'left')
            ->join('msprodi p', 'p.prodiid=us.prodiid', 'left');
        if ($id != '') {
            $x->where('us.userid', $id);
        }
        return $x->get()->getRowArray();
    }

    function getDosen($prodiid)
    {
        return $this->builder->select('us.userid, us.usercode, us.fullname, us.email, us.password, us.phonenumber, us.role, k.kampusid, k.kampusname, p.prodiid, p.prodiname, p.prodicode, us.jeniskelamin')
            ->join('mskampus k', 'k.kampusid=us.kampusid')
            ->join('msprodi p', 'p.prodiid=us.prodiid')
            ->where('p.prodiid', $prodiid)
            ->where('us.role', 'dospem')
            ->get()->getResultArray();
    }

    function store($data)
    {
        return $this->builder->insert($data);
    }

    function edit($data, $id)
    {
        return $this->builder->update($data, ['userid' => $id]);
    }

    function destroy($id)
    {
        return $this->builder->delete(['userid' => $id]);
    }

    function checkEmail($email)
    {
        return $this->builder->where('email', $email)
            ->limit(1)->get()->getRowArray();
    }

    function checkEmailLogin($email, $page)
    {
        return $this->builder->where('email', $email)
            ->where('role', $page)
            ->limit(1)->get()->getRowArray();
    }
}
