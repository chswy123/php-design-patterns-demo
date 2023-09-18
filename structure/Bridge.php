<?php

interface Implementor
{
    public function OperationImp();
}

class ConcreateImplementorA implements Implementor
{
    public function OperationImp()
    {
        echo '具体实现A' . PHP_EOL;
    }
}

class ConcreateImplementorB implements Implementor
{
    public function OperationImp()
    {
        echo '具体实现B' . PHP_EOL;
    }
}

abstract class Abstraction
{
    protected $imp;

    public function SetImplementor(Implementor $imp)
    {
        $this->imp = $imp;
    }

    abstract public function Operation();
}

class RefineAbstraction extends Abstraction
{
    public function Operation()
    {
        $this->imp->OperationImp();
    }
}

$impA = new ConcreateImplementorA();
$impB = new ConcreateImplementorB();

$ra = new RefineAbstraction();

$ra->SetImplementor($impA);
$ra->Operation();

$ra->SetImplementor($impB);
$ra->Operation();

/***********************************示例***********************************/

interface MailTemplate
{
    public function getTemplate();
}

class MailNotifyTemplate implements MailTemplate
{
    public function getTemplate()
    {
        echo '这是一个邮件通知模板...' . PHP_EOL;
    }
}

class MailAwardTemplate implements MailTemplate
{
    public function getTemplate()
    {
        echo '这是一个邮件奖励模板...' . PHP_EOL;
    }
}

class MailAdTemplate implements MailTemplate
{
    public function getTemplate()
    {
        echo '这是一个邮件广告模板...' . PHP_EOL;
    }
}

abstract class BaseMailAbstract
{
    protected $imp;

    public function setMailTemplate($imp)
    {
        $this->imp = $imp;
    }

    abstract public function sendOp();

}

class OpMail extends BaseMailAbstract
{
    public function sendOp()
    {
        $this->imp->getTemplate();
        echo '发送邮件...' . PHP_EOL;
    }
}

$opMail = new OpMail();
$awardMail = new MailAwardTemplate();

$opMail->setMailTemplate($awardMail);
$opMail->sendOp();

$notifyMail = new MailNotifyTemplate();
$opMail->setMailTemplate($notifyMail);
$opMail->sendOp();