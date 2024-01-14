<?php

namespace App\Models;

use CodeIgniter\Model;

class Trkonsultasi extends Model
{
    protected $table = 'trkonsultasi ks';

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    function getKonsul()
    {
        $x = $this->builder->select('ks.konsulid, k.kampusid, k.kampusname, p.prodiid, p.prodiname, p.prodicode, dosenprodi.prodiid as dosenprodiid, dosenprodi.prodiname as dosenprodiname, dosenprodi.prodicode as dosenprodiname, dosenkampus.kampusid as dosenkampusid, dosenkampus.kampusname as dosenkampusname, t.topicid, t.topicname, st.topicid as subtopicid, st.topicname as subtopicname, d.userid as dosenid, d.fullname as dosenname, d.jeniskelamin as dosen_jenkel, us.userid, us.fullname, us.jeniskelamin as user_jenkel, ks.tanggal, ks.jamfrom, ks.jamto, ks.status, ks.reason, ks.link, d.phonenumber as dosen_phone, us.phonenumber as user_phone, us.email as user_mail, d.email as dosen_email, ks.link, ks.reason, ks.status')
            ->join('mskampus k', 'k.kampusid=ks.kampusid')
            ->join('msprodi p', 'p.prodiid=ks.prodiid')
            ->join('mstopic t', 't.topicid=ks.topicid')
            ->join('mstopic st', 'st.topicid=ks.topicdtid')
            ->join('msuser d', 'd.userid=ks.dosenid')
            ->join('mskampus dosenkampus', 'dosenkampus.kampusid=d.kampusid')
            ->join('msprodi dosenprodi', 'dosenprodi.prodiid=d.prodiid')
            ->join('msuser us', 'us.userid=ks.userid');
        if (session()->get('role') == 'dospem') {
            $x->where('d.userid', session()->get('userid'))
                ->whereNotIn('status', ['reject']);
        } elseif (session()->get('role') == 'user') {
            $x->where('us.userid', session()->get('userid'));
        }

        return $x->get()->getResultArray();
    }

    function getOne($id)
    {
        return $this->builder->select('ks.konsulid, k.kampusid, k.kampusname, p.prodiid, p.prodiname, dosenprodi.prodiid as dosenprodiid, dosenprodi.prodiname as dosenprodiname, dosenprodi.prodicode as dosenprodiname, dosenkampus.kampusid as dosenkampusid, dosenkampus.kampusname as dosenkampusname, t.topicid, t.topicname, st.topicid as subtopicid, st.topicname as subtopicname, d.userid as dosenid, d.fullname as dosenname, d.jeniskelamin as dosen_jenkel, us.userid, us.fullname, us.jeniskelamin as user_jenkel, ks.tanggal, ks.jamfrom, ks.jamto, ks.status,  ks.reason, ks.link, d.phonenumber as dosen_phone, us.phonenumber as user_phone, us.email as user_mail, d.email as dosen_email, ks.link, ks.reason, ks.status')
            ->join('mskampus k', 'k.kampusid=ks.kampusid')
            ->join('msprodi p', 'p.prodiid=ks.prodiid')
            ->join('mstopic t', 't.topicid=ks.topicid')
            ->join('mstopic st', 'st.topicid=ks.topicdtid')
            ->join('msuser d', 'd.userid=ks.dosenid')
            ->join('msuser us', 'us.userid=ks.userid')
            ->join('mskampus dosenkampus', 'dosenkampus.kampusid=d.kampusid')
            ->join('msprodi dosenprodi', 'dosenprodi.prodiid=d.prodiid')
            ->where('ks.konsulid', $id)
            ->get()->getRowArray();
    }

    function store($data)
    {
        return $this->builder->insert($data);
    }

    function edit($data, $id)
    {
        return $this->builder->update($data, ['konsulid' => $id]);
    }

    function destroy($id)
    {
        return $this->builder->delete(['konsulid' => $id]);
    }
}
