<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

/**
 * 文章控制器
 */
class Article extends AdminBase
{
    
    /**
     * 文章列表
     */
    public function articleList()
    {
        
        $where = $this->request->logicArticle->getWhere($this->param);
        
        $this->assign('list', $this->request->logicArticle->getArticleList($where, true, 'create_time desc'));
        
        return $this->fetch('article_list');
    }
    
    /**
     * 文章添加
     */
    public function articleAdd()
    {
        
        $this->articleCommon();
        
        return $this->fetch('article_edit');
    }
    
    /**
     * 文章编辑
     */
    public function articleEdit()
    {
        
        $this->articleCommon();
        
        $info = $this->request->logicArticle->getArticleInfo(['id' => $this->param['id']]);
        
        !empty($info) && $info['img_ids_array'] = str2arr($info['img_ids']);
        
        $this->assign('info', $info);
        
        return $this->fetch('article_edit');
    }
    
    /**
     * 文章添加与编辑通用方法
     */
    public function articleCommon()
    {
        
        IS_POST && $this->jump($this->request->logicArticle->articleEdit($this->param));
        
        $this->assign('article_category_list', $this->request->logicArticle->getArticleCategoryList([], 'id,name', '', false));
    }
    
    /**
     * 文章分类添加
     */
    public function articleCategoryAdd()
    {
        
        IS_POST && $this->jump($this->request->logicArticle->articleCategoryEdit($this->param));
        
        return $this->fetch('article_category_edit');
    }
    
    /**
     * 文章分类编辑
     */
    public function articleCategoryEdit()
    {
        
        IS_POST && $this->jump($this->request->logicArticle->articleCategoryEdit($this->param));
        
        $info = $this->request->logicArticle->getArticleCategoryInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);
        
        return $this->fetch('article_category_edit');
    }
    
    /**
     * 文章分类列表
     */
    public function articleCategoryList()
    {
        
        $this->assign('list', $this->request->logicArticle->getArticleCategoryList());
       
        return $this->fetch('article_category_list');
    }
    
    /**
     * 文章删除
     */
    public function articleDel($id = 0)
    {
        
        $this->jump($this->request->logicArticle->articleDel(['id' => $id]));
    }
    
    /**
     * 文章分类删除
     */
    public function articleCategoryDel($id = 0)
    {
        
        $this->jump($this->request->logicArticle->articleCategoryDel(['id' => $id]));
    }
}
