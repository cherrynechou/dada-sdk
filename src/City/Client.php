<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/20 0020
 * Time: 12:22
 */
namespace CherryneChou\EasyDada\City;

use CherryneChou\EasyDada\Kernel\BaseClient;

/**
 * Class Client
 * @package CherryneChou\EasyDada\City
 */
class Client extends BaseClient
{
    /**
     * @return array
     */
    public function list()
    {
       return $this->httpPost('/api/cityCode/list');
    }
}