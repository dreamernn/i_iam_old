<?php

class Enum_Lang
{

    /**
     * 中文key
     */
    const LANG_KEY_CHINESE = 'zh';
    /**
     * 英文key
     */
    const LANG_KEY_ENGLISH = 'en';

    /**
     * 日语key
     */
    const LANG_KEY_JAPANESE = 'jp';

    /**
     * 获取语言名称列表
     */
    public static function getLangeNameList()
    {
        $langNameList = array(
            self::LANG_KEY_CHINESE => '中文',
            self::LANG_KEY_ENGLISH => 'English',
            self::LANG_KEY_JAPANESE => 'Japanese',
        );
        return $langNameList;
    }

    public static $langIndexList = array(
        self::LANG_KEY_CHINESE => 1,
        self::LANG_KEY_ENGLISH => 2,
        self::LANG_KEY_JAPANESE => 3,
    );

    public static $langNameDict = array(
        self::LANG_KEY_CHINESE => array(
            self::LANG_KEY_CHINESE => '中文',
            self::LANG_KEY_ENGLISH => '英语',
            self::LANG_KEY_JAPANESE => '日语'
        ),
        self::LANG_KEY_ENGLISH => array(
            self::LANG_KEY_CHINESE => 'Chinese',
            self::LANG_KEY_ENGLISH => 'English',
            self::LANG_KEY_JAPANESE => 'Japanese'
        ),
        self::LANG_KEY_JAPANESE => array(
            self::LANG_KEY_CHINESE => '中文',
            self::LANG_KEY_ENGLISH => '英语',
            self::LANG_KEY_JAPANESE => '日语'
        ),
    );

    /**
     * 获取当前使用的语言
     */
    public static function getSystemLang($isIndex = false)
    {
        $language = self::LANG_KEY_CHINESE;
        $cookieLanguage = Util_Http::getCookie('systemLang');
        $cookieLanguage && $language = $cookieLanguage;
        if ($isIndex) {
            if (isset(self::$langIndexList[$language])) {
                return self::$langIndexList[$language];
            } else {
                throw new Exception("Language index not exist", 1);
            }
        }
        return $language;
    }

    /**
     * 设置使用的语言
     */
    public static function setSystemLang($language)
    {
        $expire = time() + 86400 * 365;
        return Util_Http::setCookie('systemLang', $language, $expire);
    }

    private static $languageFileCache = array();

    /**
     * 从语言文件获取文本信息
     */
    private static function getConstantText($language, $page, $key)
    {
        $languageFile = "Lang_" . ucwords($language) . '_' . ucwords($page);
        if (!self::$languageFileCache[$languageFile]) {
            $sysConfig = Yaf_Registry::get('sysConfig');
            $filePath = $sysConfig->application->directory . "/library/lang/{$language}/" . ucwords($page) . '.php';
            if (file_exists($filePath)) {
                $languageClass = new ReflectionClass($languageFile);
                self::$languageFileCache[$languageFile] = $languageClass->getConstants();
            }
        }
        $text = self::$languageFileCache[$languageFile][$key];
        return strval($text);
    }

    /**
     * 获取页面展示文本信息
     */
    public static function getPageText($page, $key)
    {
        $key = strtoupper($key);
        $language = self::getSystemLang();
        $text = self::getConstantText($language, $page, $key);
        if (empty($text) && $language != self::LANG_KEY_CHINESE) {
            $text = self::getConstantText(self::LANG_KEY_CHINESE, $page, $key);
        }
        $text = $text ? $text : '';
        return $text;
    }

    /**
     * 错误信息配置
     */
    private static $errorText = array(
        'login' => array(
            4 => 'login_namepasserror'
        ),
    );

    /**
     * 获取错误信息文本
     */
    public static function getErrorText($errorLangKey, $code)
    {
        if ($code == 1) {
            $errorText = self::getPageText('system', 'systemError');
        } else {
            $errorInfo = self::$errorText[$errorLangKey][$code];
            if ($errorInfo) {
                $errorInfoList = explode('_', $errorInfo);
                $errorText = self::getPageText($errorInfoList[0], $errorInfoList[1]);
            }
        }
        return $errorText;
    }

    public static function getLangDisplayName($lang, $displayLang = self::LANG_KEY_CHINESE)
    {
        if (empty(self::$langNameDict[$displayLang])) {
            $displayLang = self::LANG_KEY_CHINESE;
        }
        $tmp = self::$langNameDict[$displayLang];
        if (empty($tmp[$lang])) {
            $lang = self::LANG_KEY_CHINESE;
        }
        return $tmp[$lang];
    }
}