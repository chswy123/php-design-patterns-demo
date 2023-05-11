<?php
/**
 * 单例模式
 */

class Singleton {
    private static $instance;
    private $name;

    private function __construct()
    {
        // 构造方法私有化，外部不能直接实例化这个类
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Singleton();
        }

        return self::$instance;

    }

    public function Get()
    {
        echo '发送Get请求...' . PHP_EOL;
    }

    public function Post()
    {
        echo '发送Post请求...' . PHP_EOL;
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }


}

$a = Singleton::getInstance();
$b = Singleton::getInstance();

var_dump($a, $b);

$a->Get();
$b->Post();
