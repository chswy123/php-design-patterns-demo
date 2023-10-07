<?php

/**
 * 责任链模式
 */
abstract class Handler
{
    protected $successor;
    public function setSuccessor($successor)
    {
        $this->successor = $successor;
    }
    abstract public function handleRequest($request);
}

class ConcreateHanlder1 extends Handler
{
    public function handleRequest($request)
    {
        if (is_numeric($request)) {
            return '请求参数是数字：' . $request;
        } else {
            return $this->successor->handleRequest($request);
        }
    }
}

class ConcreateHandler2 extends Handler
{
    public function handleRequest($request)
    {
        if (is_string($request)) {
            return '请求参数是字符串:' . $request;
        } else {
            return $this->successor->handleRequest($request);
        }
    }
}

class ConcreateHanlder3 extends Handler
{
    public function handleRequest($request)
    {
        return '类型:' . gettype($request);
    }
}

$handle1 = new ConcreateHanlder1();
$handle2 = new ConcreateHandler2();
$handler3 = new ConcreateHanlder3();

$handle1->setSuccessor($handle2);
$handle2->setSuccessor($handler3);

$request = [22, 'aa', 55, 'cc', [1,2,3], null, new stdClass()];

foreach ($request as $val) {
    echo $handle1->handleRequest($val) . PHP_EOL;
}