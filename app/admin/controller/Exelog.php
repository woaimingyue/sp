<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 执行记录控制器
 */
class Exelog extends AdminBase
{
    
    /**
     * 全局范围列表
     */
    public function appList()
    {
        
        $this->assign('list', $this->request->logicExeLog->getLogList(['type' => DATA_DISABLE], true, TIME_CT_NAME . ' desc'));
        
        return $this->fetch('app_list');
    }
    
    /**
     * 接口范围列表
     */
    public function apiList()
    {
        
        $this->assign('list', $this->request->logicExeLog->getLogList(['type' => DATA_NORMAL], true, TIME_CT_NAME . ' desc'));
        
        return $this->fetch('api_list');
    }
  
    /**
     * 日志入库
     */
    public function logImport()
    {
        
        $this->jump($this->request->logicExeLog->logImport());
    }
  
    /**
     * 日志清空
     */
    public function logClean()
    {
        
        $this->jump($this->request->logicExeLog->logDel([DATA_STATUS_NAME => DATA_NORMAL]));
    }
}
