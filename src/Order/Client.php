<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/20 0020
 * Time: 12:08
 */
namespace CherryneChou\EasyDada\Order;

use CherryneChou\EasyDada\Kernel\BaseClient;

/**
 * Class Client
 * @package CherryneChou\EasyDada\Order
 */
class Client extends BaseClient
{
    /**
     * 发送订单
     * @param array $param
     * @return array
     */
    public function add($param=[])
    {
        return $this->httpPost('/api/order/addOrder', $param);
    }

    /**
     * 重新发送订单
     * @param array $param
     * @return array
     */
    public function reAdd($param=[])
    {
        return $this->httpPost('/api/order/reAddOrder',$param);
    }

    /**
     * 取消订单
     * @param array $param
     * @return array
     */
    public function cancel($param=[])
    {
        return $this->httpPost('/api/order/formalCancel',$param);
    }

    /**
     * 取消原因
     * @param array $param
     * @return array
     */
    public function cancelReasons($param=[])
    {
        return $this->httpPost('/api/order/cancel/reasons',$param);
    }
}