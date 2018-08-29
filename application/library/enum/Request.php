<?php

/**
 * 用户枚举
 * @author ZXM
 * 2015年7月13日
 */
class Enum_Request {

    const RPC_REQUEST_UA = "Iservice/1.0(iam;)";

    public static function getUrlConfigById($interfaceId)
    {
        $config = array(
            'APP' => 'Rpc_UrlConfigApp',
            'AU' => 'Rpc_UrlConfigAdmin',
            'B' => 'Rpc_UrlConfigBase',
            'C' => 'Rpc_UrlConfigComment',
            'CG' => 'Rpc_UrlConfigConfig',
            'F' => 'Rpc_UrlConfigFeedback',
            'GA' => 'Rpc_UrlConfigActivity',
            'GH' => 'Rpc_UrlConfigHotel',
            'GS' => 'Rpc_UrlConfigShopping',
            'GSH' => 'Rpc_UrlConfigShowing',
            'IS' => 'Rpc_UrlConfigService',
            'LI' => 'Rpc_UrlConfigLife',
            'N' => 'Rpc_UrlConfigNotic',
            'NT' => 'Rpc_UrlConfigNews',
            'P' => 'Rpc_UrlConfigPromotion',
            'PT' => 'Rpc_UrlConfigPoi',
            'R' => 'Rpc_UrlConfigRoom',
            'RT' => 'Rpc_UrlConfigRobot',
            'S' => 'Rpc_UrlConfigSign',
            'SF' => 'Rpc_UrlConfigStaff',
            'T' => 'Rpc_UrlConfigTel',
            'U' => 'Rpc_UrlConfigUser',
        );
        $fileKey = preg_replace('/\d+/', '', $interfaceId);
        $fileNameKey = $config[$fileKey];
        if (empty($fileNameKey)) {
            return false;
        }
        $interfaceConfig = $fileNameKey::getConfig($interfaceId);
        if ($interfaceConfig) {
            return $interfaceConfig;
        } else {
            return false;
        }
    }
}
