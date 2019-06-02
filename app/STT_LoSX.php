<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class STT_LoSX extends Model
{
    //
    protected $table = 'stt_losx';
    protected $primaryKey = ['MaLo', 'MaSP', 'STT'];
    public $incrementing = false;

    public function daily(){
        return $this->hasOne('App\DaiLy','MaDL','MaDL');
    }
}
