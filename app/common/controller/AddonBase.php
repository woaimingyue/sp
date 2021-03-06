<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\controller;

/**
 * 插件控制器基类
 */
class AddonBase extends ControllerBase
{
    
    /**
     * 重写加载模板输出
     * @access protected
     * @param string $template 模板文件名
     * @param array  $vars     模板输出变量
     * @param array  $replace  模板替换
     * @param array  $config   模板参数
     * @return mixed
     */
    protected function fetch($template = '', $vars = [], $replace = [], $config = [])
    {
        
        $class = get_class($this);
        
        $addon_name = strtolower(substr($class, DATA_NORMAL + strrpos($class, SYS_DS_CONS)));
        
        $view_path = PATH_ADDON . $addon_name . DS . LAYER_VIEW_NAME . DS;
        
        $static_path = SYS_DS_PROS .SYS_ADDON_DIR_NAME. SYS_DS_PROS . $addon_name . SYS_DS_PROS . SYS_STATIC_DIR_NAME;
        
        $replace_default['__STATIC__'] = $static_path; 
        
        $this->view->engine(['view_path' => $view_path]);
        
        echo $this->view->fetch($template, $vars, array_merge($replace_default, $replace), $config);
    }
}
