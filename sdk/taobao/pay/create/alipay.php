<?php
require_once("lib/alipay_submit.class.php");
class pay {
    
    
    public    $payment_type = "1";
        //必填，不能修改
        //服务器异步通知页面路径
    public    $notify_url = "http://www.sifu010.com/pay/asy";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
    public    $return_url = "http://www.sifu010.com/pay/syn";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //卖家支付宝帐户
    public    $seller_email = 'zyhyab4691@163.com';
        //必填

        //商户订单号
    public    $out_trade_no = '';
        //商户网站订单系统中唯一订单号，必填

        //订单名称
    public    $subject = '包月服务';
        //必填

        //付款金额
    public    $price = 100;
        //必填

        //商品数量
    public     $quantity = "1";
        //必填，建议默认为1，不改变值，把一次交易看成是一次下订单而非购买一件商品
        //物流费用
    public    $logistics_fee = "0.00";
        //必填，即运费
        //物流类型
    public    $logistics_type = "EXPRESS";
        //必填，三个值可选：EXPRESS（快递）、POST（平邮）、EMS（EMS）
        //物流支付方式
    public    $logistics_payment = "SELLER_PAY";
        //必填，两个值可选：SELLER_PAY（卖家承担运费）、BUYER_PAY（买家承担运费）
        //订单描述

    public    $body = '';
        //商品展示地址
    public    $show_url = '';
        //需以http://开头的完整路径，如：http://www.xxx.com/myorder.html

        //收货人姓名
    public    $receive_name = '';
        //如：张三

        //收货人地址
    public    $receive_address = '';
        //如：XX省XXX市XXX区XXX路XXX小区XXX栋XXX单元XXX号

        //收货人邮编
    public    $receive_zip = '';
        //如：123456

        //收货人电话号码
    public    $receive_phone = '';
        //如：0571-88158090

        //收货人手机号码
    public    $receive_mobile = '';

    public $alipay='';
    
    public function __construct($num,$name='包月服务',$price='100'){
         
        $this->alipay=C('ALICONFIG');
        $this->alipay['cacert']=preg_replace('/\\\\/','/',$this->alipay['cacert']);
        $this->out_trade_no=$num;
        $this->subject=$name;
        $this->price=$price;
        $this->send();
        
    }

    public function send(){
        $parameter = array(
		"service" => "create_partner_trade_by_buyer",
		"partner" => trim($this->alipay['partner']),
		"payment_type"	=> $this->payment_type,
		"notify_url"	=> $this->notify_url,
		"return_url"	=> $this->return_url,
		"seller_email"	=> $this->seller_email,
		"out_trade_no"	=> $this->out_trade_no,
		"subject"	=> $this->subject,
		"price"	=> $this->price,
		"quantity"	=> $this->quantity,
		"logistics_fee"	=> $this->logistics_fee,
		"logistics_type"	=> $this->logistics_type,
		"logistics_payment"	=> $this->logistics_payment,
		"body"	=> $this->body,
		"show_url"	=> $this->show_url,
		"receive_name"	=> $this->receive_name,
		"receive_address"	=> $this->receive_address,
		"receive_zip"	=> $this->receive_zip,
		"receive_phone"	=> $this->receive_phone,
		"receive_mobile"	=> $this->receive_mobile,
		"_input_charset"	=> trim(strtolower($this->alipay['input_charset']))
    );

    $alipaySubmit = new AlipaySubmit($this->alipay);
    $html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
    echo $html_text;
    
            
    }
    
}

