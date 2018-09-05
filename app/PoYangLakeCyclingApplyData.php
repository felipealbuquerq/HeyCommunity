<?php

namespace App;

class PoYangLakeCyclingApplyData extends BaseModel
{
    /**
     * Genders
     */
    public static $genders = [
        1       =>  '男性',
        2       =>  '女性',
    ];

    /**
     * Groups
     */
    public static $groups = [
        1       =>  '业余男子公路组',
        2       =>  '业余男子山地青年组',
        3       =>  '业余男子山地壮年组',
        4       =>  '业余山地女子组',
    ];

    /**
     * States
     */
    public static $states = [
        0       =>  '待审核',
        1       =>  '审核通过',
        2       =>  '审核未通过',
    ];
}
