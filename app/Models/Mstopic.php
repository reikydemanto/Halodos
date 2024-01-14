<?php

namespace App\Models;

use CodeIgniter\Model;

class Mstopic extends Model
{
    protected $table = 'mstopic t';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function searchable()
    {
        return [
            null,
            't.topicname',
            'tm.topicname',
            'p.prodiname',
            null,
            null
        ];
    }

    function getData()
    {
        $x = $this->builder->select('t.topicid, t.topicname, t.images, tm.topicid as masterid, tm.topicname as mastername, p.prodiname, p.prodiid')
            ->join('mstopic tm', 'tm.topicid=t.masterid', 'left')
            ->join('msprodi p', 'p.prodiid=t.prodiid');
        if (session()->get('role') == 'dospem') {
            $x->where('k.kampusid', session()->get('kampusid'))
                ->where('p.prodiid', session()->get('prodiid'));
        }
        return $x;
    }

    function getOne($id = '')
    {
        $x = $this->builder->select('t.topicid, t.topicname, t.images, tm.topicid as masterid, tm.topicname as mastername, p.prodiname, p.prodiid, p.prodicode')
            ->join('mstopic tm', 'tm.topicid=t.masterid', 'left')
            ->join('msprodi p', 'p.prodiid=t.prodiid');
        if ($id != '') {
            $x->where('t.topicid', $id);
        }
        return $x->get()->getRowArray();
    }

    function store($data)
    {
        return $this->builder->insert($data);
    }

    function edit($data, $id)
    {
        return $this->builder->update($data, ['topicid' => $id]);
    }

    function destroy($id)
    {
        return $this->builder->delete(['topicid' => $id]);
    }

    function getMaster($search = '')
    {
        $x = $this->builder->select('t.topicname, t.topicid, p.prodiname, t.images')
            ->join('msprodi p', 'p.prodiid=t.prodiid');
        if (session()->get('role') == 'user') {
            $query_dt = "SELECT masterid, GROUP_CONCAT(CONCAT(topicid, '|||', topicname), '[_]') as list_subs from mstopic where masterid is not null group by masterid";
            $x->select('dts.list_subs')
                ->join("($query_dt) dts", 'dts.masterid=t.topicid');
        }
        $x->where('t.masterid is null');
        if (session()->get('role') == 'dospem' || session()->get('role') == 'user') {
            $x->like('lower(t.topicname)', strtolower($search))
                ->where('t.prodiid', session()->get('prodiid'));
        } else if (session()->get('role') == 'admin') {
            $x->where("(lower(t.topicname) like '%" . strtolower($search) . "%')", null, false);
        }
        return $x->get()->getResultArray();
    }

    function getSubs($masterid, $search = '')
    {
        return $this->builder->select('t.topicname, t.topicid, p.prodiname, t.images')
            ->join('msprodi p', 'p.prodiid=t.prodiid')
            ->where('t.masterid', $masterid)
            ->like('lower(t.topicname)', strtolower($search))->get()->getResultArray();
    }
}
