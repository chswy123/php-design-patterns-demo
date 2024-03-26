<?php

/**
 * 迭代器模式
 */


interface Aggregate
{
    public function CreateIterator();
}

class ConcreteAggregate implements Aggregate
{
    public function CreateIterator()
    {
        $list = ['a', 'b', 'c', 'd'];

        return new ConcreteIterator($list);
    }
}

interface MyIterator
{
    public function First();
    public function Next();
    public function IsDone();
    public function CurrentItem();
}

class ConcreteIterator implements MyIterator
{
    private $list;
    private $index;

    public function __construct($list)
    {
        $this->list = $list;
        $this->index = 0;
    }

    public function First()
    {
        $this->index = 0;
    }

    public function IsDone()
    {
        return $this->index >= count($this->list);
    }

    public function CurrentItem()
    {
        return $this->list[$this->index];
    }

    public function Next()
    {
        $this->index++;
    }

    public function CurIndex()
    {
        return $this->index;
    }

}


$aggregate = new ConcreteAggregate();
$iterator = $aggregate->CreateIterator();

while (!$iterator->IsDone()) {
    echo $iterator->CurrentItem() . PHP_EOL;
    $iterator->Next();
}