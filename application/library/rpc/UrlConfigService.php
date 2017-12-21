<?php

/**
 * Class Rpc_UrlConfigService
 */
class Rpc_UrlConfigService
{
    private static $config = array(
        'IS001' => array(
            'name' => 'Get task category list',
            'method' => 'getTaskCategoryList',
            'auth' => true,
            'url' => '/service/getTaskCategoryList',
            'param' => array(
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'IS002' => array(
            'name' => 'Add a new task category',
            'method' => 'addTaskCategory',
            'auth' => true,
            'url' => '/service/addTaskCategory',
            'param' => array(
                'hotelid' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'parentid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'IS003' => array(
            'name' => 'Update task category by ID',
            'method' => 'updateTaskCategory',
            'auth' => true,
            'url' => '/service/updateTaskCategory',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang3' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'parentid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),

        'IS004' => array(
            'name' => 'Get task list',
            'method' => 'getTaskList',
            'auth' => true,
            'url' => '/service/getTaskList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'category_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),
        'IS005' => array(
            'name' => 'Add a new task',
            'method' => 'addTask',
            'auth' => true,
            'url' => '/service/addTask',
            'param' => array(
                'title_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'price' => array(
                    'required' => false,
                    'format' => 'float',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'category_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),
        'IS006' => array(
            'name' => 'Update task  by ID',
            'method' => 'updateTask',
            'auth' => true,
            'url' => '/service/updateTask',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'title_lang1' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'title_lang2' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'price' => array(
                    'required' => false,
                    'format' => 'float',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'category_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'pic' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'department_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'staff_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'highest_level' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'level_interval_1' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'level_interval_2' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'level_interval_3' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'level_interval_4' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'level_interval_5' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'sms' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'email' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),

            )
        ),

        'IS007' => array(
            'name' => 'Get task order list',
            'method' => 'getTaskOrderList',
            'auth' => true,
            'url' => '/service/getTaskOrderList',
            'param' => array(
                'id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'category_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'hotelid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'limit' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'page' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),

        'IS008' => array(
            'name' => 'Add a new task order',
            'method' => 'addTaskOrder',
            'auth' => true,
            'url' => '/service/addTaskOrder',
            'param' => array(
                'task_id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'room_no' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'count' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'admin_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'memo' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
            )
        ),

        'IS009' => array(
            'name' => 'Update task order by ID',
            'method' => 'updateTaskOrder',
            'auth' => true,
            'url' => '/service/updateTaskOrder',
            'param' => array(
                'id' => array(
                    'required' => true,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'task_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'userid' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'count' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'status' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'admin_id' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
                'memo' => array(
                    'required' => false,
                    'format' => 'string',
                    'style' => 'interface'
                ),
                'delay' => array(
                    'required' => false,
                    'format' => 'int',
                    'style' => 'interface'
                ),
            )
        ),

    );

    use Rpc_TraitGetConfig;
}
