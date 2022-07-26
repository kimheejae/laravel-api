<?php

namespace Tests\Feature;

use App\Models\Good;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class GoodTest extends TestCase
{

    public function test_상품입력()
    {
        $url = '/api/v1/goods';

        $formData = [
            'goods_nm' => '나이키 모자',
            'goods_cont' => 'NIKE',
            'com_id' => 'm123'
        ];

        $response = $this->post($url, $formData);

        $response->assertStatus(Response::HTTP_CREATED);

        //입력한 상품 조회
        $good = Good::first();
        $goodId = $good->goods_no;

        $isExist = Good::where('goods_no', '=', $goodId)->count() > 0;

        $this->assertTrue($isExist);
    }

    public function test_상품조회()
    {
        $url = '/api/v1/goods?goods_nm=나이키모자&goods_cont=Nike';

        $response = $this->get($url);

        $response->assertStatus(Response::HTTP_OK);
    }


    public function test_없는상품조회()
    {
        $url = '/api/v1/goods?goods_nm=없는상품&goods_cont=없는상품';

        $response = $this->get($url);

        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_상품업데이트()
    {
        //상품 입력 후
        $good = new Good();
        $good->goods_nm='아디다스 모자';
        $good->save();

        $good = Good::first();
        $goodId = $good->goods_no;

        $url = '/api/v1/goods/'.$goodId;

        $data = [
            'goods_nm' => 'nike',
            'goods_cont' => '나이키'
        ];

        $response = $this->put($url, $data);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_없는상품번호조회()
    {
        $this->withExceptionHandling();

        $url = '/api/v1/goods/4';

        $response = $this->get($url);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

}
