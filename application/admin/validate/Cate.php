<?php

namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename' => 'require|max:25|unique',
    ];

    protected $message = [
        'catename.require' => '栏目名称不能为空',
        'catename.max' => '栏目名称不能大于25位',
        'catename.uniqune'=>''
    ];

    protected $scene = [
        'add' => ['catename' => 'require|unique:cate'],
        'edit' => ['catename' => 'require|unique:cate'],
    ];
}
