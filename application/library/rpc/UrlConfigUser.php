<?php

/**
 * Class Rpc_UrlConfigUser
 */
class Rpc_UrlConfigUser
{
    private static $config = array(
        'U001' => array(
            'name' => '获取入住用户列表',
            'method' => 'getUserList',
            'auth' => true,
            'url' => '/User/getUserList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                )
            )
        ),
    );

    use Rpc_TraitGetConfig;
}
