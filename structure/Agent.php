<?php

/**
 * 代理模式
 */
interface Subject
{
    public function Request();
}

class RealSubject implements Subject
{
    public function Request()
    {
        echo '这是真实操作...' . PHP_EOL;
    }
}

class Proxy implements Subject
{
    private $realSubject;

    public function __construct()
    {
        $this->realSubject = new RealSubject();
    }

    public function Request()
    {
        echo '这是代理操作...' . PHP_EOL;
        $this->realSubject->Request();
    }

}

$proxy = new Proxy();
$proxy->Request();