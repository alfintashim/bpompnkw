<?

function notif_baru($notif)
{
    return DB::table('aduans')->where('notif',$notif)->count();
}

function notif_baru_disposisi($notif)
{
    return DB::table('aduans')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->where('aduans.notif',$notif)
        ->where('log_aduans.bidang','Bidang Informasi dan Komunikasi')
        ->count();
}

function notif_total()
{
    $disposisi = DB::table('aduans')
        ->join('log_aduans','aduans.id','=','log_aduans.id_aduan')
        ->where('aduans.notif',3)
        ->where('log_aduans.bidang','Bidang Informasi dan Komunikasi')
        ->count();
        
    $lain = DB::table('aduans')->whereIn('notif',[1,4])->count();
    
    return $disposisi + $lain;
}

function notif_tindaklanjut()
{
    return DB::table('aduans')->where('notif',2)->count();
}