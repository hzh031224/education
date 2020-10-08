<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Goods as GoodsModel;

class GoodsController extends Controller
{
    // 商品详情
    public function detail(Request $request,$id){
        $good_detail = GoodsModel::find($id);
        dd($good_detail);
    }
    // 商品列表
    public function index(){
        echo '列表';
    }
}
