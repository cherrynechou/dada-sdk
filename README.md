<h1 align="center"> 达达Sdk </h1>

<p align="center"> this is dada for laravel.</p>


## Installing

```shell
$ composer require cherrynechou/dada -vvv
```

## Usage

TODO

### 配置文件样例

#### 达达配置
$config=[
    'is_sandbox'=>true,
    'app_key' => '',
    'app_secret' => '',
    'source_id' => '',  
]


$app = new Application($config);

### 使用方法

#### 添加门店
$app->shop->add(...);

#### 添加订单
$app->order->add(...);

### 获取城市列表
$app->city->list();

## License

MIT