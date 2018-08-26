<?php

class Enum_System
{

    const RPC_REQUEST_PACKAGE = 'iam';
    const ALL = 'all';
    const COMMA_SEPARATOR = ',';

    private static $_apiDomain;

    /**
     * Get the api domain from config file
     *
     * @param $url
     * @return string
     */
    public static function getServiceApiUrlByLink($url)
    {
        if (!self::$_apiDomain) {
            $sysConfig = Yaf_Registry::get('sysConfig');
            self::$_apiDomain = $sysConfig->api->domain;
        }
        $url = strpos('http', $url) ? $url : self::$_apiDomain . $url;
        return $url;
    }


    /**
     * Check if dev environment
     *
     * @return bool
     */
    public static function isDev(): bool
    {
        $sysConfig = Yaf_Registry::get('sysConfig');
        return isset($sysConfig->application->env) && $sysConfig->application->env == 'dev';
    }
}

?>
