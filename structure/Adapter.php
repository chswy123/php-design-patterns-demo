<?php

interface Target
{
    public function Request();
}

class Adapter implements Target
{
    private $adaptee;

    public function __construct($adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function Request()
    {
        $this->adaptee->specificRequest();
    }

}

class Adaptee
{
    public function specificRequest()
    {
        echo '我是A标准' . PHP_EOL;
    }
}

$adaptee = new Adaptee();
$adapter = new Adapter($adaptee);
$adapter->Request();

/***********************************示例***********************************/

class ZjBan
{
    public function info()
    {
        echo '展示浙江玩家封禁信息...' . PHP_EOL;
    }

    public function banPlayer()
    {
        echo '执行浙江玩家封禁操作...' . PHP_EOL;
    }

}

class QgSouthBanAdapter extends ZjBan
{
    private $banObj;

    public function __construct($banObj)
    {
        $this->banObj = $banObj;
    }

    public function info()
    {
        $this->banObj->southInfo();
    }

    public function banPlayer()
    {
        $this->banObj->southBanPlayer();
    }

}

class QgSouthBan
{
    public function southInfo()
    {
        echo '展示全国包南方玩家封禁信息...' . PHP_EOL;
    }

    public function southBanPlayer()
    {
        echo '执行全国包南方玩家封禁操作...' . PHP_EOL;
    }
}

class QgNorthBanAdapter extends ZjBan
{
    private $banObj;

    public function __construct($banObj)
    {
        $this->banObj = $banObj;
    }

    public function info()
    {
        $this->banObj->northInfo();
    }

    public function banPlayer()
    {
        $this->banObj->northBanPlayer();
    }

}

class QgNorthBan
{
    public function northInfo()
    {
        echo '展示全国包北方玩家封禁信息...' . PHP_EOL;
    }

    public function northBanPlayer()
    {
        echo '执行全国包北方玩家封禁操作...' . PHP_EOL;
    }

}

// 浙江包
$zjBan = new ZjBan();
$zjBan->info();
$zjBan->banPlayer();

// 全国包南方
$qgSouthBan = new QgSouthBan();
$qgSouthBanAdapter = new QgSouthBanAdapter($qgSouthBan);
$qgSouthBanAdapter->info();
$qgSouthBanAdapter->banPlayer();

// 全国包北方
$qgNorthBan = new QgNorthBan();
$qgNorthBanAdapter = new QgNorthBanAdapter($qgNorthBan);
$qgNorthBanAdapter->info();
$qgNorthBanAdapter->banPlayer();