# 쇼핑몰의 상품등록/조회 REST API

`버전정보 : Laravel v8.83.20 (PHP v7.3.3)`

-----------
## TestCode
[`tests/Feature/GoodTest.php`](https://github.com/kimheejae/laravel-api/blob/master/tests/Feature/GoodTest.php)
```php
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
        $good=Good::first();
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

        $good=Good::first();
        $goodId = $good->goods_no;

        $url = '/api/v1/goods/'.$goodId;

        $data =[
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
```
#### 테스트결과값
![image](https://user-images.githubusercontent.com/17777873/180939467-c39801ed-ed40-407d-9ce9-9b268520a31a.png)

---------------
## API구성
| method	| url | Description |
|----------|-------------------------------------------|-----------------|
| GET  | http://127.0.0.1:8000/api/v1/goods          | 상품 목록페이지 조회 |
| GET  | http://127.0.0.1:8000/api/v1/goods/{good_no} | 개별 상품정보 조회   | 
| POST | http://127.0.0.1:8000/api/v1/goods          | 상품등록            | 
| PUT  | http://127.0.0.1:8000/api/v1/goods/{good_no} | 상품수정            |   
---------------
## 상세정보
### 상품 목록페이지 조회
+ <b>Endpoint</b>: [GET] api/v1/goods?goods_nm=티셔츠&com_id=m123
+ <b>Description</b>: 상품목록 페이지를 조회합니다.
+ <b>Request Example</b>:
    + <b>URL</b>: [GET] api/v1/goods
+ <b>Response Example</b>:
```js
{
    "data": [
        {
            "goods_no": 1,
            "goods_nm": "티셔츠1",
            "goods_cont": "LS HOODIE-LONG SLEEVE-SWEATSHIRT CLARUS COTTON PIQUE",
            "com_id": "m123",
            "reg_dm": "2022-07-21 02:38:40",
            "upd_dm": "2022-07-21 02:38:40"
        },
        {
            "goods_no": 2,
            "goods_nm": "티셔츠2",
            "goods_cont": "Polo Ralph Lauren",
            "com_id": "m123",
            "reg_dm": "2022-07-21 17:31:51",
            "upd_dm": "2022-07-21 17:31:51"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8000/api/v1/goods?page=1",
        "last": "http://127.0.0.1:8000/api/v1/goods?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8000/api/v1/goods?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8000/api/v1/goods",
        "per_page": 10,
        "to": 2,
        "total": 2
    },
    "status": "SUCCESS",
    "api-version": "1.0"
}
```
----
### 개별 상품정보 조회
+ <b>Endpoint</b>: [GET] api/v1/goods/{good_no}
+ <b>Description</b>: good_no가 {good_no}인 상품을 리턴합니다.
+ <b>Request Example</b>:
    + <b>URL</b>: [GET] api/v1/goods/30
+ <b>Response Example</b>:
```js
{
    "data": {
        "goods_no": 30,
        "goods_nm": "양말6",
        "goods_cont": "Lacoste",
        "com_id": "a322",
        "reg_dm": "2022-07-21 02:38:40",
        "upd_dm": "2022-07-21 02:38:40"
    },
    "status": "SUCCESS",
    "api-version": "1.0"
}
```
----
### 상품등록
+ <b>Endpoint</b>: [POST] api/v1/goods
+ <b>Description</b>: 새로운 상품을 등록합니다. 새로생성된 상품정보를 리턴합니다.
+ <b>Request Example</b>:
    + <b>URL</b>: [POST] api/v1/goods
    + <b>Body</b>: 
```js
{
    "goods_no": "39",
    "goods_nm": "나이키모자",
    "goods_cont": "NIKE L91 TECH CAP",
    "com_id": "m123",
}
```
+ <b>Response Example</b>:
```js
{
    "data": {
        "goods_no": "39",
        "goods_nm": "나이키모자",
        "goods_cont": "NIKE L91 TECH CAP",
        "com_id": "m123",
        "reg_dm": "2022-07-25 11:12:02",
        "upd_dm": "2022-07-25 11:12:02"
    },
    "status": "SUCCESS",
    "api-version": "1.0"
}
```
----
### 상품수정
+ <b>Endpoint</b>: [PUT] api/v1/goods/{good_no}
+ <b>Description</b>: good_no가 {good_no}인 상품을 수정합니다.
+ <b>Request Example</b>:
    + URL: [PUT] api/v1/goods/39
    + Body: 
```js
{
    "goods_nm": "아디다스모자",
    "goods_cont": "Adidas CAP",
}
```
+ <b>Response Example</b>:
```js
{
    "data": {
        "goods_no": 39,
        "goods_nm": "아디다스모자",
        "goods_cont": "Adidas CAP",
        "com_id": "m123",
        "reg_dm": "2022-07-25 11:12:02",
        "upd_dm": "2022-07-25 11:20:40"
    },
    "status": "SUCCESS",
    "api-version": "1.0"
}
```
----
### API 호출실패
```js
{
    "status": "FAIL"
}
```

----------------------------------

## 주요 과제

### 마이그레이션으로 테이블 생성 
[`database/migrations/2022_07_21_013636_create_goods_table.php`](https://github.com/kimheejae/laravel-api/blob/master/database/migrations/2022_07_21_013636_create_goods_table.php)

```php
Schema::create('goods', function (Blueprint $table) {
$table->integer('goods_no')->nullable(false)->default('0')->comment('상품번호');
    $table->string('goods_nm',100)->nullable()->comment('상품명')->collation('utf8_general_ci');
    $table->text('goods_cont')->nullable()->comment('상품설명')->collation('utf8_general_ci');
    $table->string('com_id',20)->nullable()->comment('업체 아이디')->collation('utf8_general_ci');
    $table->dateTime('reg_dm')->nullable()->comment('상품정보 최초등록일시');
    $table->dateTime('upd_dm')->nullable()->comment('상품정보 수정일시');
    $table->primary('goods_no');
});
DB::statement("ALTER TABLE `goods` COMMENT '상품마스터' COLLATE 'utf8_general_ci'");
```



### API버전별 라우트 분리

[`app/Providers/RouteServiceProvider.php`](https://github.com/kimheejae/laravel-api/blob/master/app/Providers/RouteServiceProvider.php)

```php
protected function mapApiRoutes()
{
    //버전별 라우터 분리
    Route::group([
        'middleware' => ['api', 'api_version:v1'],
        'namespace'  => "{$this->apiNamespace}\\v1",
        'prefix'     => 'api/v1',
    ], function ($router) {
        require base_path('routes/api_v1.php');
    });

    Route::group([
        'middleware' => ['api', 'api_version:v2'],
        'namespace'  => "{$this->apiNamespace}\\v2",
        'prefix'     => 'api/v2',
    ], function ($router) {
        require base_path('routes/api_v2.php');
    });
}
```

### 1분당 60회 호출까지 허용(throttle)

[`app/Http/Kernel.php`](https://github.com/kimheejae/laravel-api/blob/master/app/Http/Kernel.php)

```php
'api' => [
            ...
            'throttle:60,1',
            ...
         ]
```
## 고려 사항

### API 호출 실패시 json타입으로 실패값 리턴

[`app/Exceptions/Handler.php`](https://github.com/kimheejae/laravel-api/blob/master/app/Exceptions/Handler.php)

```php
public function register()
{
    $this->renderable(function (NotFoundHttpException $e, $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'data' => [
                    'status' => 'FAIL'
                ]
            ], 404);
        }
    });
}
```

### 기본 Timestamp 명칭 변경

[`app/Models/Good.php`](https://github.com/kimheejae/laravel-api/blob/master/app/Models/Good.php)

```php
    const CREATED_AT = 'reg_dm';
    const UPDATED_AT = 'upd_dm';
```
