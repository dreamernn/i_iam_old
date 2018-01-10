<?php

/**
 * Class Enum_Service
 */
class Enum_Service
{
    const PERMISSION_TYPE_BASE = 1;
    const PERMISSION_TYPE_TASK = 2;
    const PERMISSION_TYPE_ALL = 3;

    /**
     * @return array
     */
    public static function getTaskProcessMustInput(): array
    {
        return array();
    }
}

?>