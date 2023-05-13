<?php
/**
 * 工厂方法模式
 */

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

abstract class MsgFactory {
    abstract public function factoryMethod();
    public function getMsg() {
        return $this->factoryMethod();
    }
}

class AliyunFactory extends MsgFactory {
    public function factoryMethod()
    {
        return new AliyunMsg();
    }
}

class CtyFactory extends MsgFactory {
    public function factoryMethod()
    {
        return new CtyMsg();
    }
}

$ctyFactory = new CtyFactory();
$ctyFactory->factoryMethod()->send();

$msg = $ctyFactory->getMsg();
$msg->send();
