<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Log_aduan;
use App\Biouser;
use App\Aduan;

Class Helper extends Model
{
    public static function createBiouser
    ($id_user)
    {
        Biouser::create([
            'id_user' => $id_user
            // 'ktp' => $ktp,
            // 'foto' => $foto
        ]);
    }
    
    public static function createLog
    ($id_aduan, $status, $bidang, $jawaban, $id_create, $note_disposisi=NULL)
    {
        if ($note_disposisi!=NULL) {
            Log_aduan::create([
                'id_aduan'       => $id_aduan,
                'status'         => $status,
                'bidang'         => $bidang,
                'id_create'      => $id_create,
                'note_disposisi' => $note_disposisi,
                'jawaban'        => $jawaban
            ]);

        }
        else{
            Log_aduan::create([
                'id_aduan'  => $id_aduan,
                'status'    => $status,
                'bidang'    => $bidang,
                'jawaban'   => $jawaban,
                'id_create' => $id_create
            ]);

        }
    }
    
    function notif_diterima()
    {
        return 'test';
    }
}