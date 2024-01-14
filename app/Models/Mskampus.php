<?php

namespace App\Models;

use CodeIgniter\Model;

class Mskampus extends Model
{
    protected $table = 'mskampus';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            'kampusname',
            'kampusaddress',
            null
        ];
    }

    function getData()
    {
        return $this->builder;
    }

    function getOne($id = '')
    {
        $x = $this->builder;
        if ($id != '') {
            $x->where('kampusid', $id);
        }
        return $x->get()->getRowArray();
    }

    function store($data)
    {
        return $this->builder->insert($data);
    }

    function edit($data, $id)
    {
        return $this->builder->update($data, ['kampusid' => $id]);
    }

    function destroy($id)
    {
        return $this->builder->delete(['kampusid' => $id]);
    }

    function getSelect($search = '')
    {
        return $this->builder
            ->like('lower(kampusname)', strtolower($search))
            ->get()->getResultArray();
    }
}
