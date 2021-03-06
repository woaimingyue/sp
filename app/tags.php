<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

// 行为目录路径
define('BEHAVIOR_PATH', 'app\\common\\behavior\\');

$data = [
    // 应用初始化
    'app_init'     => [],
    // 应用开始
    'app_begin'    => [],
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [],
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
];

// 若不为安装流程则初始化系统行为
if(BIND_MODULE != 'install') :
    
    $data['app_init']   = [BEHAVIOR_PATH . 'InitBase', BEHAVIOR_PATH . 'InitHook'];
    $data['app_begin']  = [BEHAVIOR_PATH . 'AppBegin'];
    $data['app_end']    = [BEHAVIOR_PATH . 'AppEnd'];
    
endif;

return $data;
