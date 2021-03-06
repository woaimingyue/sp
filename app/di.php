<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

/**
 * 依赖注入配置文件
 */

// 业务逻辑层路径
$common = PATH_COMMON_LOGIC;

$admin  = str_replace(SYS_COMMON_DIR_NAME, 'admin', $common);
$api    = str_replace(SYS_COMMON_DIR_NAME, 'api',   $common);
$index  = str_replace(SYS_COMMON_DIR_NAME, 'index', $common);

$prefix = 'logic';

return [
    
    // admin 模块依赖注入定义
    'admin' => [
        
        'article'   => [$common  . 'Article'    => $prefix . 'Article'],
        'seo'       => [$common  . 'Seo'        => $prefix . 'Seo'],
        'file'      => [$common  . 'File'       => $prefix . 'File'],
        'config'    => [$common  . 'Config'     => $prefix . 'Config'],
        'addon'     => [$common  . 'Addon'      => $prefix . 'Addon'],
        'api'       => [$common  . 'Api'        => $prefix . 'Api'],
        'auth'      => [$admin   . 'AuthGroup'  => $prefix . 'AuthGroup'],
        'blogroll'  => [$admin   . 'Blogroll'   => $prefix . 'Blogroll'],
        'database'  => [$admin   . 'Database'   => $prefix . 'Database'],
        'exelog'    => [$admin   . 'ExeLog'     => $prefix . 'ExeLog'],
        'fileclean' => [$admin   . 'FileClean'  => $prefix . 'FileClean'],
        'log'       => [$admin   . 'Log'        => $prefix . 'Log'],
        'login'     => [$admin   . 'Login'      => $prefix . 'Login'],
        'service'   => [$admin   . 'Service'    => $prefix . 'Service'],
        'statistic' => [$admin   . 'Statistic'  => $prefix . 'Statistic'],
        'trash'     => [$admin   . 'Trash'      => $prefix . 'Trash'],
        'member'    => [
                        $admin   . 'Member'     => $prefix . 'Member',
                        $admin   . 'AuthGroup'  => $prefix . 'AuthGroup',
                    ],
    ],
    
    // api 模块依赖注入定义
    'api' => [
        
        'index'     => [$api    . 'Document'    => $prefix . 'Document'],
    ],
    
    // index 模块依赖注入定义
    'index' => [
        
        'index'     => [$common . 'Article'     => $prefix . 'Article'],
    ],

];
