<?php
/**
 * 文档配置文件
 */
return array(
    //标题
    'title'             => '获取短信验证码',

    //说明
    'description'       => '通过mobile获取短信验证码',

    //访问地址
    'uri'               => 'http://api.beta-next.56365.com/index.php?m=code&f=send',

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
            'require'       => '是',
            'type'          => 'string(11)',
            'description'   => '只能为手机号码，app端校验合法性、非空等'
        )
    ),

    //响应数据说明
    'responseParameters' => array(
        array(
            'parameter'     => 'code',
            'name'          => '状态码',
            'require'       => '是',
            'description'   => '#CONFIG#'   //读取config/config.php配置文件
        ),
        array(
            'parameter'     => 'msg',
            'name'          => '状态信息',
            'require'       => '是',
            'description'   => '对应状态码的信息'
        ),
        array(
            'parameter'     => 'authenticode',
            'name'          => '验证码',
            'require'       => '是',
            'description'   => '本次发送的验证码（测试时使用）'
        )
    ),

    //样例
    'examples'          => array(
        'request'   => 'http://api.beta-next.56365.com/index.php?m=code&f=send',
        'response'  => array(
            '#send.json#',   //读取响应的docs下的文件
        )
    )

);