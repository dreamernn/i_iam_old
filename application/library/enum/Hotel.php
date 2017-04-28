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
}

?>