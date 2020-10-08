<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 表名
    protected $table = 'goods';
    // 主键
    protected $primaryKey = 'g_id';
    // 黑名单
    protected $guarded = [];
}
