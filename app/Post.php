<?php

namespace App;

class Post extends BaseModel
{
    /**
     * Type
     */
    public static $typeIds = [
        1       =>      '自主发布文章',
        2       =>      '链接站外文章',
    ];
}
