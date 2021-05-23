<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/20 0020
 * Time: 11:55
 */
namespace CherryneChou\EasyDada\Balance;

use CherryneChou\EasyDada\Kernel\BaseClient;

/**
 * Class Client
 * @package CherryneChou\EasyDada\Merchant
 */
class Client extends BaseClient
{
    /**
     * 查询余额
     * @param array $param
     * @return array
     */
    public function query($param=[])
    {
      return $this->httpPost('/api/balance/query', $param);
    }
}
