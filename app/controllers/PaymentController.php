<?php

namespace app\controllers;


class PaymentController extends AppController
{
    public function paySuccessAction()
    {
        if (empty($_POST)) die;
        $dataSet = $_POST;
        $order = \R::load('order', (int)$dataSet['ik_pm_no']);
        $log = \R::load('order_log', $order->log_id);
        if ($dataSet['ik_inv_st'] === 'success' && $order) {
            $order->status = 'paid';
            \R::store($order);
            if ($log) {
                $new_log =  self::addLog($log->log);
                $log->log = $new_log;
                $log->status = 'paid';
                \R::store($log);
            }
        }
        $this->setMeta('LW | Payment Successfully');
    }

    public function payErrorAction()
    {
        $this->setMeta('LW | Payment Failed');
    }

    public function payWaitAction()
    {
        $this->setMeta('LW | Payment Wait');
    }

    public function formAction()
    {
        $this->setMeta('LW | Payment Wait');
    }


    protected static function addLog($data)
    {
        $time = date("Y-m-d H:i:s");
        return $data . ",paid?$time";
    }

}