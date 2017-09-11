<?php
return array(
	//'配置项'=>'配置值'
	'URL_MODEl' => 2,


// mysql或者mysqli
	'DB_TYPE'        =>  'mysql',
	'DB_HOST'        =>  'localhost',
	'DB_NAME'        =>  'demo2',
	'DB_USER'        =>  'root',
	'DB_PWD'         =>  'root',
	'DB_PORT'        =>  3306,
	'DB_PREFIX'      =>  'cc_',
	'DB_CHARSET'     =>  'utf8',


	// PDO方式连接
	// 'DB_TYPE'        =>  'mysql',
	// 'DB_USER'        =>  'root',
	// 'DB_PWD'         =>  'root',
	// 'DB_PREFIX'      =>  'cc_',
	// 'DB_DSN'     =>  'mysql:host = 127.0.0.1;dbname = demo2;charset=utf8',

	'SHOW_PAGE_TRACE'=>true,

	'SERVER_root' => "http://".$_SERVER['SERVER_NAME'],

	'Think_Email' =>array(
		'HOST'       =>'smtp.163.com',
		'USERNAME'   =>'wangxic0917@163.com',
		'PASSWORD'   =>'me1336918',
		'SMTPAuth'   =>true,
		'SMTPSecure' =>'',
		'PORT'       =>25
		),



	'LANG_SWITCH_ON' => true,   // 开启语言包功能
	'LANG_AUTO_DETECT' => true, // 自动侦测语言 开启多语言功能后有效
	'LANG_LIST'        => 'zh-cn,en-us,zh-tw', // 允许切换的语言列表 用逗号分隔
	'VAR_LANGUAGE'     => 'lang', // 默认语言切换变量

);