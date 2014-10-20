<?php
return array(
    //顶部菜单
    'menu' => array(
        'user' => array(
            'title'         => '会员',
            'description'   => '会员说明',
            'method'        => array(
                'reg',
                'login',
                'changePassword',
                'forgetPassword',
				'code-send'

            )
        ),
        'code' => array(
            'title'         => '验证码',
            'method'        => array(
                'send'
            )
        )
    ),

    /**
     * 每个文档对应的事项;
     * showType: code,table,p(normal);default:p
     */
    'items' => array(
        'uri'                   => array(
            'name'      => '请求地址',
            'showType'  => 'code'
        ),
        'supportedFormat'       => array(
            'name'      => '返回数据支持格式'
        ),
        'requestMethod'         => array(
            'name'      => '请求方式'
        ),
        'limitation'            => array(
            'name'      => '每页获取条数'
        ),
        'requestParameters'     => array(
            'name'      => '请求参数说明',
            'showType'  => 'table'
        ),
        'responseParameters'    => array(
            'name'      => '响应参数说明',
            'showType'  => 'table'
        ),
        'examples'              => array(
            'name'      => '样例',
            'showType'  => 'code',
            'child'     => array(
                'request' => array(
                    'name'      => '请求',
                    'showType'  => 'code'
                ),
                'response' => array(
                    'name'      => '响应',
                    'showType'  => 'code'
                )
            )
        )
    ),

    //表格对应的字段
    'tableColumns' => array(
        'parameter'     => '参数',
        'name'          => '名称',
        'required'      => '必选',
        'type'          => '类型',
        'description'   => '说明'
    )
);
