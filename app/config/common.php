<?php
return array(
    'basePath' => realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'),
    'name' => 'Insided Funda Assignment',

    // preloading 'log' component
    'preload' => array('log'),

    // application components
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=insided',
            'emulatePrepare' => true,
            'username' => 'root',
            //dirty hack to avoid separate config files
            'password' => getenv('APPLICATION_ENV') === 'dev' ? '' : 'root',
            'charset' => 'utf8',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
//                    'levels' => 'error, warning',
                    'levels' => 'trace,info,profile,warning,error', //for developing purposes
                ),
            ),
        ),
        'fundaClient' => array(
            'class' => 'ext.funda.FundaClient',
            'key' => 'a001e6c3ee6e4853ab18fe44cc1494de',
            'fetch_pagesize' => 25,
        ),
        'cache' => array(
            'class' => 'system.caching.CMemCache',
            'servers' => array(
                array('host' => 'localhost', 'port' => 11211),
            ),
            'hashKey' => false, //my default YII memcache uses hash function to store keys! very unusual!
            'keyPrefix' => '',
            'serializer' => false,
        ),
    ),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'ext.funda.*',
        'ext.MemCacheKeys',
    ),
);
