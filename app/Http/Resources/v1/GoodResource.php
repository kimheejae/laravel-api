<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'goods_no' => $this->goods_no,
            'goods_nm' => $this->goods_nm,
            'goods_cont' => $this->goods_cont,
            'com_id' => $this->com_id,
            'reg_dm' => $this->reg_dm,
            'upd_dm' => $this->upd_dm
        ];
    }


    public function with($request)
    {
        return [
            'status' => 'SUCCESS',
            'api-version' => '1.0',
        ];
    }


}
