<?php

class Rpc_UrlConfigStaff {

    private static $config = array(
        'SF001' => array(
            'name' => 'Get staff list',
            'method' => 'getStaffList',
            'auth' => true,
            'url' => '/Staff/getStaffList',
            'param' => array(
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'name' => array(
                    'required' => false,
                    'format' => 'string',
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
        'SF002' => array(
            'name' => 'Reset pin for user',
            'method' => 'getStaffList',
            'auth' => true,
            'url' => '/Staff/resetUserPin',
            'param' => array(
                'token' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'SF003' => array(
            'name' => 'update staff detail',
            'method' => 'updateStaffById',
            'auth' => true,
            'url' => '/Staff/updateStaffById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'schedule' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'washing_push' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'permission' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'SF004' => array(
            'name' => '获取物业后台管理员帐号权限列表',
            'method' => 'getStaffPermission',
            'auth' => true,
            'url' => '/HotelAdministrator/getStaffPermission',
            'param' => array(
                'type' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            ),
        ),
    );

    use Rpc_TraitGetConfig;
}
