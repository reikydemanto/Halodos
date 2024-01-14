<?php

namespace App\Models;

use CodeIgniter\Model;

class Msprodi extends Model
{
    protected $table = 'msprodi p';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            'p.prodicode',
            'p.prodiname',
            null
        ];
    }

    function getData()
    {
        return $this->builder->select('p.prodiid, p.prodiname, p.prodicode');
    }

    function getOne($id = '')
    {
        $x = $this->builder->select('p.prodiid, p.prodiname, p.prodicode');
        if ($id != '') {
            $x->where('p.prodiid', $id);
        }
        return $x->get()->getRowArray();
    }

    function store($data)
    {
        return $this->builder->insert($data);
    }

    function edit($data, $id)
    {
        return $this->builder->update($data, ['prodiid' => $id]);
    }

    function destroy($id)
    {
        return $this->builder->delete(['prodiid' => $id]);
    }

    function getProdi($search = '')
    {
        return $this->builder
            ->where("(lower(prodicode) like '%" . strtolower($search) . "%' or lower(prodiname) like '%" . strtolower($search) . "%')", null, false)
            ->get()->getResultArray();
    }
}
