<?php

/**
 * 命令模式
 */
class Invoker
{
    private $command = [];

    public function setCommand($command)
    {
        $this->command[] = $command;
    }

    public function exec()
    {
        if (count($this->command) > 0) {
            foreach ($this->command as $command) {
                $command->execute();
            }
        }
    }

    public function undo()
    {
        if (count($this->command) > 0) {
            foreach ($this->command as $command) {
                $command->undo();
            }
        }
    }
}

abstract class Command
{
    protected $receiver;
    protected $state;
    protected $name;

    public function __construct($receiver, $name)
    {
        $this->receiver = $receiver;
        $this->name = $name;
    }

    abstract public function execute();
}

class ConcreateCommand extends Command
{

    public function execute()
    {
        if (!$this->state || $this->state == 2) {
            $this->receiver->action();
            $this->state = 1;
        } else {
            echo $this->name . '命令正在执行, 无法再次执行了' . PHP_EOL;
        }
    }

    public function undo()
    {
        if ($this->state == 1) {
            $this->receiver->undo();
            $this->state = 2;
        } else {
            echo $this->name . '命令未执行，无法撤销了' . PHP_EOL;
        }

    }
}

class Receiver
{
    public $name;
    public function __construct($name)
    {
        $this->name = $name;
    }

    public function action()
    {
        echo $this->name . '命令执行了' . PHP_EOL;
    }

    public function undo()
    {
        echo $this->name . '命令撤销了' . PHP_EOL;
    }
}

// 准备执行者
$receiverA = new Receiver('A');
$receiverB = new Receiver('B');
$receiverC = new Receiver('C');

// 准备命令
$commandOne = new ConcreateCommand($receiverA, 'A');
$commandTwo = new ConcreateCommand($receiverA, 'B');
$commandThr = new ConcreateCommand($receiverA, 'C');

// 请求者
$invoker = new Invoker();
$invoker->setCommand($commandOne);
$invoker->setCommand($commandTwo);
$invoker->setCommand($commandThr);
$invoker->exec();
$invoker->undo();

// 新加一个单独的执行者，只执行一个命令
$invokerA = new Invoker();
$invokerA->setCommand($commandOne);
$invokerA->exec();

// 命令A已经执行了，再次执行全部的命令执行者，A命令的state判断无法生效
$invoker->exec();


/***********************************示例***********************************/


class SendMsg
{
    private $command = [];

    public function setCommand(SendCommand $command)
    {
        $this->command[] = $command;
    }

    public function send($msg)
    {
        foreach ($this->command as $command) {
            $command->execute($msg);
        }
    }
}

abstract class SendCommand
{
    protected $receiver = [];

    public function setReceiver($receiver)
    {
        $this->receiver[] = $receiver;
    }

    abstract public function execute($msg);
}

class SendAliYun extends SendCommand
{
    public function execute($msg)
    {
        foreach ($this->receiver as $receiver) {
            $receiver->action($msg);
        }
    }
}

class SendJiGuang extends SendCommand
{
    public function execute($msg)
    {
        foreach ($this->receiver as $receiver) {
            $receiver->action($msg);
        }
    }
}

class SendAliYunMsg
{
    public function action($msg)
    {
        echo '【阿里云短信】发送：' . $msg, PHP_EOL;
    }
}

class SendAliYunPush
{
    public function action($msg)
    {
        echo '【阿里云推送】发送：' . $msg, PHP_EOL;
    }
}

class SendJiGuangMsg
{
    public function action($msg)
    {
        echo '【极光短信】发送：' . $msg, PHP_EOL;
    }
}

class SendJiGuangPush
{
    public function action($msg)
    {
        echo '【极光推送】发送：' . $msg, PHP_EOL;
    }
}

$aliMsg = new SendAliYunMsg();
$aliPush = new SendAliYunPush();
$jgMsg = new SendJiGuangMsg();
$jgPush = new SendJiGuangPush();

$sendAliYun = new SendAliYun();
$sendAliYun->setReceiver($aliMsg);
$sendAliYun->setReceiver($aliPush);

$sendJiGuang = new SendJiGuang();
$sendAliYun->setReceiver($jgMsg);
$sendAliYun->setReceiver($jgPush);

$sendMsg = new SendMsg();
$sendMsg->setCommand($sendAliYun);
$sendMsg->setCommand($sendJiGuang);

$sendMsg->send('测试发送，测试发送');