<?php

class send {

	
        //支付宝交易号
     public   $trade_no = '';
        //必填

        //物流公司名称
     public   $logistics_name = '';
        //必填

        //物流发货单号

      public  $invoice_no = '';
        //物流运输类型
      public  $transport_type = 'POST';
        //三个值可选：POST（平邮）、EXPRESS（快递）、EMS（EMS）
        
        public $alipay_config='';
        public $status=false;
        
        public function __construct($trade_no,$name){
      
        	 $this->alipay_config=C('ALICONFIG');
        	   $this->alipay_config['cacert']=preg_replace('/\\\\/','/',$this->alipay_config['cacert']);
        	 $this->trade_no=$trade_no;
        	 $this->logistics_name=$name;
        	 $this->invoice_no=uniqid();
        	  $this->trade();
        }
        public function trade(){
          $parameter = array(
		"service" => "send_goods_confirm_by_platform",
		"partner" => trim($this->alipay_config['partner']),
		"trade_no"	=> $this->trade_no,
		"logistics_name"	=> $this->logistics_name,
		"invoice_no"	=> $this->invoice_no,
		"transport_type"	=> $this->transport_type,
		"_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
);

include("./sdk/taobao/pay/create/lib/alipay_submit.class.php");
        $alipaySubmit = new AlipaySubmit($this->alipay_config);
      
$html_text = $alipaySubmit->buildRequestHttp($parameter);

$doc = new DOMDocument();
$doc->loadXML($html_text);

        if( ! empty($doc->getElementsByTagName( "alipay" )->item(0)->nodeValue) ) {
	$alipay = $doc->getElementsByTagName( "alipay" )->item(0)->nodeValue;
	//echo $alipay;
	$this->status=true;
}
        }
    
      
}