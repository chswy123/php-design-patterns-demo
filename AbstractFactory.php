<?php
/**
 * 抽象工厂模式
 */

// 商品A抽象接口
interface AbstractProductA {
    public function show();
}

// 商品A1实现
class ProductA1 implements AbstractProductA {
    public function show()
    {
        echo '展示商品A1...' . PHP_EOL;
    }
}

// 商品A2实现
class ProductA2 implements AbstractProductA {
    public function show()
    {
        echo '展示商品A2...' . PHP_EOL;
    }
}

// 商品B抽象接口
interface AbstractProductB {
    public function view();
}

// 商品B1实现
class ProductB1 implements AbstractProductB {
    public function view()
    {
        echo '预览商品B1...' . PHP_EOL;
    }
}

// 商品B2实现
class ProductB2 implements AbstractProductB {
    public function view()
    {
        echo '预览商品B2...' . PHP_EOL;
    }
}

// 抽象工厂接口
interface AbstractFactory {
    public function CreateProductA();
    public function CreateProductB();
}

// 工厂1，实现商品A1和商品B1
class ConcreateFactory1 implements AbstractFactory {
    public function CreateProductA()
    {
        return new ProductA1();
    }
    public function CreateProductB()
    {
        return new ProductB1();
    }
}

// 工厂2，实现商品A2和商品B2
class ConcreateFactory2 implements AbstractFactory {
    public function CreateProductA()
    {
        return new ProductA2();
    }
    public function CreateProductB()
    {
        return new ProductB2();
    }
}

$factory1 = new ConcreateFactory1();
$factory1->CreateProductA()->show();
$factory1->CreateProductB()->view();



/*********************实例***********************/

// 短信推送抽象接口
interface Msg {
    public function send();
}

// 阿里云短信发送实现
class AliyunMsg implements Msg {
    public function send()
    {
        echo '发送阿里云短信...' . PHP_EOL;
    }
}

// 畅天游短信发送实现
class CtyMsg implements Msg {
    public function send()
    {
        echo '发送畅天游短信...' . PHP_EOL;
    }
}

// 奖励发放抽象接口
interface Award {
    public function sendGift();
}

// 浙江包奖励发放
class ZjAward implements Award {
    public function sendGift()
    {
        echo '地方包奖励发放...' . PHP_EOL;
    }
}

// 全国包奖励发放
class QgAward implements Award {
    public function sendGift()
    {
        echo '全国包奖励发放...' . PHP_EOL;
    }
}

// 抽象 发送短信、奖励工厂
interface SendMsgAndAwardFactory {
    public function sendMsg();
    public function sendAward();
}

class ZjSend implements SendMsgAndAwardFactory {
    public function sendMsg()
    {
        return new AliyunMsg();
    }
    public function sendAward()
    {
        return new ZjAward();
    }
}

$zjSend = new ZjSend();
$zjSend->sendMsg()->send();
$zjSend->sendAward()->sendGift();