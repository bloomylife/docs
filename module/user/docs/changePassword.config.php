<?php
/**
 * 文档配置文件
 */
return array(
    //标题
    'title'             => '修改密码',

    //说明
    'description'       => '通过用户的密码，需提供用户名（手机号）、原始密码、新密码、秘钥',

    //访问地址
    'uri'               => 'http://api.beta-next.56365.com/index.php?m=user&f=changePassword',

    //返回数据支持的格式
    'supportedFormat'   => 'XML/JSON',

    //每页显示数目
    'limitation'        => '',

    //请求方式
    'requestMethod'     => 'POST',

    //请求参数说明
    'requestParameters' => array(
        array(
            'parameter'     => 'username',
            'name'          => '用户名',
            'required'       => '是',
            'type'          => 'string(11)',
            'description'   => '只能为电话号码，app 端校验合法性、非空等；服务器端需要做合法性校验和是否存在等'
        ),
        array(
            'parameter'     => 'oldpwd',
            'name'          => '原密码',
            'required'       => '是',
            'type'          => 'string',
            'description'   => 'app端做合法性、非空等校验；密码要求由字母、数字、下划线组成；'
        ),
        array(
            'parameter'     => 'newpwd',
            'name'          => '新密码',
            'required'       => '是',
            'type'          => 'string',
            'description'   => 'app端做合法性、非空等校验；密码要求由字母、数字、下划线组成；'
        ),
        array(
            'parameter'     => 'secret',
            'name'          => '秘钥',
            'required'       => '是',
            'type'          => 'string',
            'description'   => ''
        )
    ),

    //响应数据说明
    'responseParameters' => array(
        array(
            'parameter'     => 'code',
            'name'          => '状态码',
            'required'       => '是',
            'description'   => '#CONFIG#'   //读取config/config.php配置文件
        ),
        array(
            'parameter'     => 'msg',
            'name'          => '状态信息',
            'required'       => '是',
            'description'   => '对应状态码的信息'
        )
    ),

    //样例
    'examples'          => array(
        'request'   => 'http://api.beta-next.56365.com/index.php?m=user&f=changePassword',
        'response'  => array(
        )
    )

);