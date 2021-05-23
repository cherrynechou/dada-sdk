<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/9/18 0018
 * Time: 17:29
 */

namespace CherryneChou\EasyDada;

use CherryneChou\EasyDada\Kernel\Support\Collection;
use Pimple\Container;

/**
 * Class Factory
 * @package CherryneChou\EasyDada
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        City\ServiceProvider::class,
        Order\ServiceProvider::class,
        Shop\ServiceProvider::class,
        Balance\ServiceProvider::class,
        Merchant\ServiceProvider::class,
    ];

    /**
     * Application constructor.
     * @param array $config
     * @param array $values
     */
    public function __construct($config = [], array $values = [])
    {
        parent::__construct($values);

        $this['config'] = function () use ($config) {
            return new Collection($config);
        };

        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }


    /**
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this[$name];
    }
}
