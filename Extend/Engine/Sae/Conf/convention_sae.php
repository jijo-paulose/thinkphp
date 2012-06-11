<?php
//sae下的固定配置,以下配置将会覆盖项目配置。
return array(
        'DB_TYPE'=> 'mysql',     // 数据库类型
	'DB_HOST'=> SAE_MYSQL_HOST_M.','.SAE_MYSQL_HOST_S, // 服务器地址
	'DB_NAME'=> SAE_MYSQL_DB,        // 数据库名
	'DB_USER'=> SAE_MYSQL_USER,    // 用户名
	'DB_PWD'=> SAE_MYSQL_PASS,         // 密码
	'DB_PORT'=> SAE_MYSQL_PORT,        // 端口
	'DB_RW_SEPARATE'=>true,
            'DATA_CACHE_TYPE'=>'Memcache',//SAE下，缓存类型改为Memcache
        'DB_DEPLOY_TYPE'=> 1, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
        //备用数据库配置，mysql被禁用时启用
        'SPARE_DB_HOST'=>'',
        'SPARE_DB_NAME'=>'',
        'SPARE_DB_USER'=>'',
        'SPARE_DB_PWD'=>'',
        'SPARE_DB_PORT'=>'',
        'SPARE_DB_WRITEABLE'=>false,//备用数据库是否允许写入数据
        'SPARE_INFO_FUNCTION'=>'',//给用户显示提示信息的函数
        //短信预警设置
        'SMS_ON'=>false,//短信预警开关
        'SMS_MOBILE'=>'',//接收短信的手机号
        'SMS_LEVEL'=>'ERR,MYSQL_ERROR,USER',//可以设置的有：ERR,MYSQL_ERROR,USER,NOTIC
        'SMS_INTERVAL'=>1800,//发送短信的间隔频率
        'SMS_SIGN'=>'',//短信签名， 如果有多个网站，可以用它来识别是哪个网站在进行短信报警
        'SAE_SPECIALIZED_FILES'=>array(
            //SAE系统专属文件。
            'UploadFile.class.php'=>SAE_PATH.'Lib/Extend/Library/ORG/Net/UploadFile_sae.class.php',
            'Image.class.php'=>SAE_PATH.'Lib/Extend/Library/ORG/Util/Image_sae.class.php',
            'CacheMemcache.class.php'=>SAE_PATH.'Lib/Extend/Driver/Cache/CacheMemcache_sae.class.php',
            'DbMysql.class.php'=>SAE_PATH.'Lib/Driver/Db/DbMysql.class.php',
            'DbMysqli.class.php'=>SAE_PATH.'Lib/Driver/Db/DbMysqli.class.php',//TODU, 判断是否在SAE平台可用
         )
        );
