<?php
/**
 * 建造者模式(生成器模式)
 */

class Product
{
    private $parts = [];

    public function Add($part)
    {
        $this->parts[] = $part;
    }

    public function Show()
    {
        echo PHP_EOL . '产品创建 ----' . PHP_EOL;
        foreach ($this->parts as $part) {
            echo $part . PHP_EOL;
        }
    }

}

interface Builder
{
    public function builderPartA();
    public function builderPartB();
    public function getResult();
}

class ConcreateBuilder1 implements Builder
{

    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function builderPartA()
    {
        $this->product->Add('部件A');
    }

    public function builderPartB()
    {
        $this->product->Add('部件B');
    }

    public function getResult()
    {
        return $this->product;
    }
}

class ConcreateBuilder2 implements Builder
{
    private $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function builderPartA()
    {
        $this->product->Add('部件X');
    }

    public function builderPartB()
    {
        $this->product->Add('部件Y');
    }

    public function getResult()
    {
        return $this->product;
    }
}

class Director
{
    public function Construct(Builder $builder)
    {
        $builder->BuilderPartA();
        $builder->BuilderPartB();
    }
}

$director = new Director();
$builder1 = new ConcreateBuilder1();
$builder2 = new ConcreateBuilder2();

$director->Construct($builder1);
$director->Construct($builder2);

//var_dump($builder1->getResult()->Show());
//print_r($builder2->getResult()->show());




/*********************实例***********************/

class TaskSys
{
    private $taskName = '';
    private $taskDesc = '';
    private $awardCount = 0;
    private $level = [];

    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }

    public function setTaskDesc($taskDesc)
    {
        $this->taskDesc = $taskDesc;
    }

    public function setAwardCount($awardCount)
    {
        $this->awardCount = $awardCount;
    }

    public function addLevel($level)
    {
        $this->level[] = $level;
    }

    public function showTaskInfo()
    {
        echo '任务信息...' . PHP_EOL;
        echo '任务名称:' . $this->taskName . PHP_EOL;
        echo '任务描述:' . $this->taskDesc . PHP_EOL;
        echo '奖励数量:' . $this->awardCount . PHP_EOL;
        foreach ($this->level as $level) {
            echo '任务层级';
            print_r($level) . PHP_EOL;
        }
    }

}

interface TaskBuilder
{
    public function buildName($taskName);
    public function buildDesc($taskDesc);
    public function buildAwardCount($awardCount);
    public function buildLevel($level);
    public function printInfo();
}

class DoTaskBuilder implements TaskBuilder
{
    private $provider;

    public function __construct()
    {
        $this->provider = new TaskSys();
    }

    public function buildName($taskName)
    {
        $this->provider->setTaskName($taskName);
    }

    public function buildDesc($taskDesc)
    {
        $this->provider->setTaskDesc($taskDesc);
    }

    public function buildAwardCount($awardCount)
    {
        $this->provider->setAwardCount($awardCount);
    }

    public function buildLevel($level)
    {
        $this->provider->addLevel($level);
    }

    public function printInfo()
    {
        return $this->provider;
    }
}

class TaskDetail1
{
    public function createOne(TaskBuilder $taskBuilder)
    {
        $taskBuilder->buildName('自定义任务1');
        $taskBuilder->buildDesc('这是自定义任务1啊啊啊');
        $taskBuilder->buildAwardCount(2);

        $taskBuilder->buildLevel(['desc' => '第一个任务...']);
        $taskBuilder->buildLevel(['desc' => '第二个任务...']);

    }

}

class TaskDetail2
{
    public function createOne(TaskBuilder $taskBuilder)
    {
        $taskBuilder->buildName('自定义任务2');
        $taskBuilder->buildDesc('这是自定义任务2啊啊啊');
        $taskBuilder->buildAwardCount(3);

        $taskBuilder->buildLevel(['desc' => '第一个任务...']);
        $taskBuilder->buildLevel(['desc' => '第二个任务...']);
        $taskBuilder->buildLevel(['desc' => '第三个任务...']);


    }
}

$task1 = new TaskDetail1();
$taskBuilder = new DoTaskBuilder();

$task1->createOne($taskBuilder);
$taskBuilder->printInfo()->showTaskInfo();

$task2 = new TaskDetail2();
$taskBuilder = new DoTaskBuilder();

$task2->createOne($taskBuilder);
$taskBuilder->printInfo()->showTaskInfo();
