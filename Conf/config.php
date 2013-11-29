<?php
return array(
	//'配置项'=>'配置值'
   
    'URL_MODEL'=>1,
    'URL_CASE_INSENSITIVE' =>  true,
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'localhost',
    'URL_HTML_SUFFIX'=>'html',
	'DB_NAME'=>'primir',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_PREFIX'=>'mir_',
    'APP_GROUP_LIST' => 'Home,Admin',
    'DEFAULT_GROUP'  => 'Home',
	'ALICONFIG'=>array(
		'partner'=> '2088002242791533',
                                'key'=>'owiu66hld5ciquwz4e2tw78ogrdjdsc3',
                                'sign_type'=>strtoupper('MD5'),
                                'input_charset'=>strtolower('utf-8'),
                                'cacert'=>getcwd().'./sdk/taobao/pay/create/cacert.pem',
                                'transport'=>'http',
                            ),

    //网站地址
    'WEB_SITE'=>'122.234.238.166',
    //定义邮件验证时间 ,单位秒
    'CHECK_TIME_EMAIL'=>3600,
   //邮件配置
'THINK_EMAIL' => array(
    'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器
    'SMTP_PORT'   => '465', //SMTP服务器端口
    'SMTP_USER'   => 'zyhyab4691@163.com', //SMTP服务器用户名
    'SMTP_PASS'   => 'zyhyab469a', //SMTP服务器密码
    'FROM_EMAIL'  => 'zyhyab4691@163.com', //发件人EMAIL
    'FROM_NAME'   => '私服010', //发件人名称
    'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
    'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
 ),
   
);
?>
