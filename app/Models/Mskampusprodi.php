<?php

namespace App\Models;

use CodeIgniter\Model;

class Mskampusprodi extends Model
{
    protected $table = 'mskampusprodi kp';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    function store($data)
    {
        return $this->builder->insert($data);
    }

    function destroy($id)
    {
        return $this->builder->delete(['kpid' => $id]);
    }

    function getProdiByKampus($kampusid, $search = '')
    {
        return $this->builder->select('p.prodiid, p.prodiname, p.prodicode')
            ->join('msprodi p', 'p.prodiid=kp.prodiid')
            ->where('kp.kampusid', $kampusid)
            ->where("(lower(p.prodicode) like '%" . strtolower($search) . "%' or lower(p.prodiname) like '%" . strtolower($search) . "%')", null, false)
            ->get()->getResultArray();
    }

    function checkKampusProdi($kampusid, $prodiid)
    {
        return $this->builder->where('kampusid', $kampusid)
            ->where('prodiid', $prodiid)
            ->limit(1)
            ->get()->getRowArray();
    }
}
