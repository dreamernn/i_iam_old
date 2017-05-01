<?php

class Enum_Hotel {

    public static function getHotelMustInput() {
        return array(
            'nameLang1',
            'lng',
            'lat',
            'bookurl',
        );
    }

    public static function getFloorMustInput() {
        return array(
            'floor',
            'pic',
        );
    }

    public static function getFacilitiesInput() {
        return array(
            'nameLang1',
        );
    }

    public static function getTrafficInput() {
        return array(
            'introductLang1',
        );
    }

    public static function getPanoramicInput() {
        return array(
            'titleLang1',
        );
    }
}

?>