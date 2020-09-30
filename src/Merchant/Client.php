<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/20 0020
 * Time: 11:55
 */
namespace CherryneChou\EasyDada\Merchant;

use CherryneChou\EasyDada\Kernel\BaseClient;

/**
 * Class Client
 * @package CherryneChou\EasyDada\Merchant
 */
class Client extends BaseClient
{
    /**
     * 注册商户
     * @param array $param
     * @return array
     */
    public function create($param=[])
    {
        return $this->httpPost('/merchantApi/merchant/add', $param);
    }
}