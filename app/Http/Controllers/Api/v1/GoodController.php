<?php
namespace App\Http\Controllers\Api\v1;

use App\Models\Good;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\v1\GoodResource;
use App\Http\Resources\v1\GoodCollection;
use Illuminate\Http\Resources\Json\JsonResource;


class GoodController extends Controller
{

    public function index(Request $request)
    {

        $page=$request->get('page')-1;

        $limit =  $request->query('limit', 10);

        $goods = Good::skip($page*$limit)->take($limit);

        //상품이름 LIKE 검색
        if($request->get('goods_nm')){
            $goods=$goods->where('goods_nm', 'LIKE', '%'.$request->get('goods_nm').'%');
        }
        //업체코드
        if($request->get('com_id')){
            $goods=$goods->where('com_id',$request->get('com_id'));
        }
        //상품설명 LIKE 검색
        if($request->get('goods_cont')){
            $goods=$goods->where('goods_cont', 'LIKE', '%'.$request->get('goods_cont').'%');
        }

        $goods = $goods->paginate(10);

        return new GoodCollection($goods);
    }

    public function show($id)
    {
        $good = Good::where('goods_no', $id)->firstOrFail();

        return new GoodResource($good);
    }

    public function store(Request $request)
    {
        //마지막 id값가져 오기
        $categoryId=Good::orderByDesc('goods_no')->first();
        //데이터가 없으면 goods_no 1입력
        if($categoryId) {
            $autoIncId = $categoryId->goods_no + 1;
        }else {
            $autoIncId=1;
        }

        $data = $request->all();
        $good = new Good($data);
        $good->goods_no = $autoIncId;
        $good->save();

        return new GoodResource($good);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $good = Good::find($id);
        $good->fill($data);
        $good->save();

        return new GoodResource($good);

    }
}
