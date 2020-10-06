<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/20 0020
 * Time: 17:10
 */
namespace CherryneChou\EasyDada\Shop;

use CherryneChou\EasyDada\Kernel\BaseClient;
use Pimple\Container;

/**
 * Class Client
 * @package CherryneChou\EasyDada\Shop
 */
class Client extends BaseClient
{
    /**
     * @param array $params
     * @return array
     */
    public function add($params=[])
    {
        return $this->httpPost('/api/shop/add', [$params]);
    }

    /**
     * @param $originId
     * @param array $params
     * @return array
     */
    public function update($originId, $params=[])
    {
        $paramKey= [
            'origin_shop_id'=>$originId
        ];

        return $this->httpPost('/api/shop/update', $paramKey+$params);
    }
}