<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\common\controller\ControllerBase;

/**
 * 登录控制器
 */
class Login extends ControllerBase
{
    
    /**
     * 登录
     */
    public function login()
    {
        
        is_login() && $this->jump(RESULT_REDIRECT, '已登录则跳过登录页', 'index/index');
        
        // 关闭布局
        $this->view->engine->layout(false);
        
        return $this->fetch('login');
    }
    
    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {
        
        $this->jump($this->request->logicLogin->loginHandle($username, $password, $verify));
    }
    
    /**
     * 注销登录
     */
    public function logout()
    {
        
        $this->jump($this->request->logicLogin->logout());
    }
    
    /**
     * 清理缓存
     */
    public function clearCache()
    {
        
        $this->jump($this->request->logicLogin->clearCache());
    }
    
}
