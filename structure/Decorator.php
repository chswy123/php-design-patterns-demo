<?php

/**
 * 装饰器模式
 */

interface MsgTemplate
{
    public function msg();
}

class CouponMsgTemplate implements MsgTemplate
{
    public function msg()
    {
        return '这是一个优惠券信息';
    }
}

abstract class DecoratorMsgTemplate implements MsgTemplate
{
    public $template;
    public function __construct($template)
    {
        $this->template = $template;
    }
}

class AdFilterMsg extends DecoratorMsgTemplate
{
    public function msg()
    {
        return $this->template->msg() . '+广告过滤';
    }
}

class SensitiveFilterMsg extends DecoratorMsgTemplate
{
    public function msg()
    {
        return $this->template->msg() . '+敏感词过滤';
    }
}

class Msg
{
    public $msgType = 'old';
    public function send($mt)
    {
        if ($this->msgType == 'old') {
            echo '发给内部:' . $mt->msg() . PHP_EOL;
        } else if ($this->msgType == 'new') {
            echo '发给外部:' . $mt->msg() . PHP_EOL;
        }
    }
}

$couponTmp = new CouponMsgTemplate();
$msg = new Msg();

$msg->send($couponTmp);

$adTmp = new AdFilterMsg($couponTmp);
$msg->send($adTmp);

$sensitiveTmp = new SensitiveFilterMsg($adTmp);
$msg->send($sensitiveTmp);