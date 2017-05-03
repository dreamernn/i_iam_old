<?php

class Enum_App {

    const PUSH_TYPE_HOTEL = 4;

    public static function getShareNameKeyList() {
        return array('wechat', 'qq', 'sina', 'tencentWeibo', 'renren', 'douban', 'linkedin', 'facebook', 'twitter', 'kakao');
    }

    public static function getPushMustInput() {
        return array(
            'cn_title',
            'en_title',
            'url',
        );
    }

    public static function getShortcutMustInput() {
        return array(
            'titleLang1',
            'key',
        );
    }
}

?>