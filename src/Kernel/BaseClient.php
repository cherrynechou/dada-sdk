<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/19 0019
 * Time: 16:19
 */

namespace CherryneChou\EasyDada\Kernel;

use CherryneChou\EasyDada\Application;
use Pimple\Container;
use GuzzleHttp\Client;

/**
 * Class BaseClient
 * @package CherryneChou\EasyDada\Kernel
 */
class BaseClient
{
    /**
     * @var Container
     */
    protected $app;

    /**
     * http request timeout
     * @var int
     */
    private $httpTimeout = 5;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * 商户ID
     */
    public $source_id;

    /**
     * 达达开发者app_key
     */
    public $app_key = '';

    /**
     * 达达开发者app_secret
     */
    public $app_secret = '';

    /**
     * api版本
     */
    public $v = "1.0";

    /**
     * 数据格式
     */
    public $format = "json";

    /**
     * BaseClient constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->initialize();
    }

    /**
     * 初始化是否为高度模式
     */
    public function initialize()
    {
        $isDebug = $this->isDebug();

        if($isDebug){
            $this->source_id = "73753";
            $this->baseUri = "http://newopen.qa.imdada.cn";
        }else{
            $this->source_id = $this->app['config']->get('source_id','');
            $this->baseUri = "https://newopen.imdada.cn";
        }
        $this->app_key = $this->app['config']->get('app_key');
        $this->app_secret = $this->app['config']->get('app_secret');
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->app['config']->get('is_debug', false);
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return new Client([
            'base_uri' => $this->baseUri,
            'timeout'  => $this->httpTimeout,
            'headers' => [
                'content-type' => 'application/json'
            ]
        ]);
    }

    /**
     * 签名
     * @param array $param
     * @return string
     */
    protected function _sign($param = array()){
        //1.升序排序
        ksort($param);
        //2.字符串拼接
        $args = "";
        foreach ($param as $key => $value) {
            $args.= $key . $value;
        }
        $args = $this->app_secret . $args . $this->app_secret;
        //3.MD5签名,转为大写
        $sign = strtoupper(md5($args));
        //4.返回签名
        return $sign;
    }

    /**
     * @param array $params
     * @return array
     */
    protected function bulidRequestParams($params = array()){
        $requestParams = array();
        $requestParams['app_key'] = $this->app_key;
        $requestParams['body'] = json_encode($params);
        $requestParams['format'] = $this->format;
        $requestParams['v'] = $this->v;
        $requestParams['source_id'] = $this->source_id;
        $requestParams['timestamp'] = time();
        $requestParams['signature'] = $this->_sign($requestParams);
        return $requestParams;
    }

    /**
     * @param String $url
     * @param array $data
     * @param string $format
     * @return mixed
     */
    public function httpPost(String $url, array $data=[], string $format = 'json'){

        $reqParams = $this->bulidRequestParams($data);

        $response = $this->getHttpClient()->request('POST', $url ,[
            'body' => json_encode($reqParams)
        ])->getBody()->getContents();

        return 'json' === $format ? \json_decode($response, true) : $response;
    }
}