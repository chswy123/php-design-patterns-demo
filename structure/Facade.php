<?php

/**
 * 门面模式
 */
class SubSysOne
{
    public function one()
    {
        echo '子系统方法一' . PHP_EOL;
    }
}

class SubSysTwo
{
    public function two()
    {
        echo '子系统方法二' . PHP_EOL;
    }
}

class SubSysThree
{
    public function Three()
    {
        echo '子系统方法三' . PHP_EOL;
    }
}

class SubSysFour
{
    public function Four()
    {
        echo '子系统方法四' . PHP_EOL;
    }
}

class Facade
{
    private $subSysOne;
    private $subSysTwo;
    private $subSysThree;
    private $subSysFour;

    public function __construct()
    {
        $this->subSysOne = new SubSysOne();
        $this->subSysTwo = new SubSysTwo();
        $this->subSysThree = new SubSysThree();
        $this->subSysFour = new SubSysFour();
    }

    public function actionA()
    {
        $this->subSysOne->one();
        $this->subSysTwo->two();
    }

    public function actionB()
    {
        $this->subSysThree->Three();
        $this->subSysFour->Four();
    }

}

$facade = new Facade();
$facade->actionA();
$facade->actionB();