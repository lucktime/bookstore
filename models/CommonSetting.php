<?php

namespace app\models;
use yii2mod\enum\helpers\BaseEnum;

class CommonSetting extends BaseEnum
{
    // Type_id 排序类型
    const TYPE_CLICKCOUNT_ID = 1;       // 按照点击数排序
    const TYPE_COMMENTCOUNT_ID = 2;     // 按照评论总数
    const TYPE_AUTHORFIRSHNAME_ID = 3;  // 按照作者首字母


}
