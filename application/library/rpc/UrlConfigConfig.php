<?php

class Rpc_UrlConfigConfig
{
    private static $config = array(
        'CG001' => array(
            'name' => 'Get config detail',
            'method' => 'getConfigDetail',
            'auth' => true,
            'url' => '/Config/getConfigDetail',
            'param' => array(
                'hotelid' => array(
                    'required' => 'true',
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'staffid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'name' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'CG002' => array(
            'name' => 'Update config',
            'method' => 'updateConfig',
            'auth' => true,
            'url' => '/Config/updateConfig',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'value' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
    );

    use Rpc_TraitGetConfig;
}
