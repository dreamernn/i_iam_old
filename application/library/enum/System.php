<?php

class Enum_System {

    const RPC_REQUEST_PACKAGE = 'iam';

    //const SERVICE_API_DOMAIN = 'http://testapi.liheinfo.com';
    const SERVICE_API_DOMAIN = 'http://r.api.liheinfo.com/';

    public static function getServiceApiUrlByLink($url) {
        $url = strpos('http', $url) ? $url : self::SERVICE_API_DOMAIN . $url;
        return $url;
    }
}

?>
