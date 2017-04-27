<?php

class Enum_Article {

    const ARTICLE_TYPE_ACTIVITY = 'activity';

    private static $articleTypeList = array(
        self::ARTICLE_TYPE_ACTIVITY => array(
            'interfaceId' => 'GA007',
            'field' => 'article_lang'
        )
    );

    public static function getArticleTypeList() {
        return self::$articleTypeList;
    }
}

?>