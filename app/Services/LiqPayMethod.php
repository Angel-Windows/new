<?php


namespace App\Services;


class LiqPayMethod
{
    public static function getForm($order_id, $order_summary){
        $server_url = route('server-pay',['order_id' => $order_id]);
        $result_url = route('result-pay',['order_id' => $order_id]);

        $public_key = env('LIQPAY_PUBLIC');
        $private_key= env('LIQPAY_PRIVATE');

        $liqpay = new LiqPay($public_key, $private_key);
        $html = $liqpay->cnb_form(array(
            'version'        => '3',
            'action'         => 'pay',
            'amount'         => $order_summary, // сумма заказа
            'currency'       => 'UAH',
            'description'    => 'Оплата заказа № '.$order_id,
            'order_id'       => $order_id,
            'result_url'	=>	$result_url,
            'server_url'	=>	$server_url,
            'language'		=>	'uk', // uk, en
        ));

        return array("status"=>1, 'form'=>$html, 'order_num'=>'op', 'error'=>'$error');
    }
}