<?php

class Enum_Article {

    const ARTICLE_TYPE_ACTIVITY = 'activity';
    const ARTICLE_TYPE_FLOOR = 'floor';
    const ARTICLE_TYPE_FACILITIES = 'facilities';
    const ARTICLE_TYPE_TRAFFIC = 'traffic';

    private static $articleTypeList = array(
        self::ARTICLE_TYPE_ACTIVITY => array(
            'interfaceId' => 'GA007',
            'field' => 'article_lang'
        ),
        self::ARTICLE_TYPE_FLOOR => array(
            'interfaceId' => 'GH005',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_FACILITIES => array(
            'interfaceId' => 'GH008',
            'field' => 'detail_lang'
        ),
        self::ARTICLE_TYPE_TRAFFIC => array(
            'interfaceId' => 'GH011',
            'field' => 'detail_lang'
        ),
    );

    public static function getArticleTypeList() {
        return self::$articleTypeList;
    }
}

?>