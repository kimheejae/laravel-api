<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->integer('goods_no')->nullable(false)->default('0')->comment('상품번호');
            $table->string('goods_nm',100)->nullable()->comment('상품명')->collation('utf8_general_ci');
            $table->text('goods_cont')->nullable()->comment('상품설명')->collation('utf8_general_ci');
            $table->string('com_id',20)->nullable()->comment('업체 아이디')->collation('utf8_general_ci');
            $table->dateTime('reg_dm')->nullable()->comment('상품정보 최초등록일시');
            $table->dateTime('upd_dm')->nullable()->comment('상품정보 수정일시');
            $table->primary('goods_no');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
