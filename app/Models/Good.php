<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Good extends Model
{

    const CREATED_AT = 'reg_dm';
    const UPDATED_AT = 'upd_dm';

    protected $dateFormat = 'Y-m-d H:i:s';

    protected $primaryKey = 'goods_no';
    public $incrementing = false;
    use HasFactory;

    protected $fillable = [
        'goods_no', 'goods_nm', 'goods_cont', 'com_id'
    ];


}



