<?php

/**
 * 简单工厂模式
 */
class Factory {
    public static function createProduct($type)
    {
        $product = null;
        switch ($type) {
            case 'A':
                $product = new ProductA();
                break;
            case 'B':
                $product = new ProductB();
                break;
        }
        return $product;
    }

}

interface Product {
    public function show();
}

class ProductA implements Product {
    public function show()
    {
        echo '展示A...' . PHP_EOL;
    }
}

class ProductB implements Product {
    public function show()
    {
        echo '展示B...' . PHP_EOL;
    }
}

$productA = Factory::createProduct('A');
$productB = Factory::createProduct('B');

$productA->show();
$productB->show();

/*
 * 实例
 */
class MsgFactory {
    public static function createFactory($type) {
        switch ($type) {
            case 'aliyun':
                return new AliyunMsg();
            case 'cty':
                return new CtyMsg();
            case 'jg':
                return new JdMsg();
            default:
                return null;
        }
    }
}

interface Msg {
    public function send();
}

class AliyunMsg implements Msg {
    public function send()
    {
        echo '发送阿里云短信...' . PHP_EOL;
    }
}

class CtyMsg implements Msg {
    public function send()
    {
        echo '发送畅天游短信...' . PHP_EOL;
    }
}

class JdMsg implements Msg {
    public function send()
    {
        echo '发送京东短信...' . PHP_EOL;
    }
}

$aliyunMsg = MsgFactory::createFactory('aliyun');
$ctyMsg = MsgFactory::createFactory('cty');

$aliyunMsg->send();
$ctyMsg->send();