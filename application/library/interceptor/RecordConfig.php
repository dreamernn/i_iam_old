<?php

class Interceptor_RecordConfig {

    private static $config = array(
        'Loginajax' => array(
            'moduleType' => 1,
            'action' => array(
                'dologin' => 1,
                'changepass' => 2
            )
        ),
        'Groupajax' => array(
            'moduleType' => 2,
            'action' => array(
                'createuser' => 1,
                'updateuser' => 2,
            )
        ),
        'Appajax' => array(
            'moduleType' => 3,
            'action' => array(
                'createstartmsg' => 1,
                'updatestartmsg' => 2,
                'createpush' => 3,
            )
        ),
    );

    /**
     * 获取拦截器配置
     *
     * @return array
     */
    public static function getConfig() {
        return self::$config;
    }
}

?>
