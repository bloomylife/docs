<?php
/**
 * 文档配置文件
 */
return array(
    //标题
    'title'             => '登录',

    //说明
    'description'       => '通过mobile登录',

    //访问地址
    'uri'               => 'http://api.beta-next.56365.com/index.php?m=user&f=login',

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
            'parameter'     => 'password',
            'name'          => '密码',
            'required'       => '是',
            'type'          => 'string',
            'description'   => 'app端做合法性、非空等校验；密码要求由字母、数字、下划线组成；'
        ),
        array(
            'parameter'     => 'deviceinfo',
            'name'          => '设备信息',
            'required'       => '是',
            'type'          => 'string',
            'description'   => '设备信息，会以json 方式传递给服务器'
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
        ),
        array(
            'parameter'     => 'secret',
            'name'          => '秘钥',
            'required'       => '是',
            'description'   => '每次成功登录返回一个新的秘钥'
        ),
		array(
            'result' => array(
                array(
                    'parameter'     => 'secret',
                    'name'          => '秘钥',
                    'required'       => '是',
                    'description'   => '每次成功登录返回一个新的秘钥'
                ),
                array(
                    'demo' => array(
                        array(
                            'parameter'     => 'demo',
                            'name'          => '测试',
                            'required'       => '是',
                            'description'   => '每次成功登录返回一个新的秘钥'
                        ),
                        array(
                            'demo3' => array(
                                array(
                                    'parameter'     => 'demo3',
                                    'name'          => '测试',
                                    'required'       => '是',
                                    'description'   => '每次成功登录返回一个新的秘钥'
                                ),
                            )
                        )
                    ),
                    'demo2' => array(
                        array(
                            'parameter'     => 'demo2',
                            'name'          => '测试',
                            'required'       => '是',
                            'description'   => '每次成功登录返回一个新的秘钥'
                        ),
                    )
                )
            )
        )
        /*array(
            'parameter'     => 'status',
            'name'          => '用户状态',
            'required'       => '是',
            'description'   => '0：车辆无采集\n1：车辆粗采集\n2：车辆全采集\n3：已冻结\n4：证照过期'
        ),
        array(
            'parameter'     => 'desc',
            'name'          => '状态描述',
            'required'       => '是',
            'description'   => '状态对应的文字描述'
        )*/
    ),

    //样例
    'examples'          => array(
        'request'   => 'http://api.beta-next.56365.com/index.php?m=user&f=login',
        'response'  => array(
        )
    )

);