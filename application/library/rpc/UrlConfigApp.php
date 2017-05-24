<?php

class Rpc_UrlConfigApp {

    private static $config = array(
        'APP001' => array(
            'name' => '获取APP快捷图标列表',
            'method' => 'getShortcutIconList',
            'auth' => true,
            'url' => '/ShortcutIcon/getShortcutIconList',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'APP002' => array(
            'name' => '新建APP快捷图标',
            'method' => 'addShortcutIcon',
            'auth' => true,
            'url' => '/ShortcutIcon/addShortcutIcon',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'key' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'APP003' => array(
            'name' => '修改APP快捷图标',
            'method' => 'updateShortcutIconById',
            'auth' => true,
            'url' => '/ShortcutIcon/updateShortcutIconById',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sort' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'key' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'APP004' => array(
            'name' => '获取APP推送列表',
            'method' => 'getPushList',
            'auth' => true,
            'url' => '/push/getPushList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'platform' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'type' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'dataid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'result' => array(
                    'required' => false,
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
                ),
            )
        ),
        'APP005' => array(
            'name' => '添加APP推送',
            'method' => 'addPush',
            'auth' => true,
            'url' => '/push/addPush',
            'param' => array(
                'platform' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'type' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'dataid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'cn_title' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'cn_value' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'en_title' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'en_value' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'url' => array(
                    'required' => true,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'APP006' => array(
            'name' => '获取APP分享图标列表',
            'method' => 'getShareIconList',
            'auth' => true,
            'url' => '/ShareIcon/getShareIconList',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'APP007' => array(
            'name' => '更新APP分享图标',
            'method' => 'updateShareByHotelId',
            'auth' => true,
            'url' => '/ShareIcon/updateShareByHotelId',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'share' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
    );

    /**
     * 根据接口编号获取接口配置
     *
     * @param string $interfaceId
     * @param string $configKey
     * @return multitype:multitype:string multitype:multitype:boolean string
     *         |boolean
     */
    public static function getConfig($interfaceId, $configKey = '') {
        if (isset(self::$config[$interfaceId])) {
            if (strlen($configKey) && isset(self::$config[$interfaceId][$configKey])) {
                return self::$config[$interfaceId][$configKey];
            } else {
                return self::$config[$interfaceId];
            }
        } else {
            return false;
        }
    }
}
