<?php
// +----------------------------------------------------------------------
// | Author: Bigotry <3162875@qq.com>
// +----------------------------------------------------------------------

namespace app\common\logic;

use think\Image;

/**
 * 文件处理逻辑
 */
class File extends LogicBase
{
    
    // 图片模型
    public static $pictureModel = null;
    
    // 文件模型
    public static $fileModel    = null;
    
    /**
     * 构造方法
     */
    public function __construct()
    {
        
        parent::__construct();
        
        self::$fileModel    = model($this->name);
        self::$pictureModel = model('Picture');
    }
    
    /**
     * 图片上传
     * small,medium,big
     */
    public function pictureUpload($name = 'file', $thumb_config = ['small' => 100, 'medium' => 500, 'big' => 1000])
    {
        
        $object_info = request()->file($name);
        
        $sha1  = $object_info->hash();
        
        $picture_info = self::$pictureModel->getInfo(['sha1' => $sha1], 'id,name,path,sha1');
        
        if (!empty($picture_info)) : return $picture_info; endif;
        
        $object = $object_info->move(PATH_PICTURE);
        
        $save_name = $object->getSaveName();
        
        $save_path = PATH_PICTURE . $save_name;
        
        $picture_dir_name = substr($save_name, 0, strrpos($save_name, DS));
        
        $filename = $object->getFilename();
        
        $thumb_dir_path = PATH_PICTURE . $picture_dir_name . DS . 'thumb';
        
        !file_exists($thumb_dir_path) && @mkdir($thumb_dir_path, 0777, true);
        
        Image::open($save_path)->thumb($thumb_config['small']   , $thumb_config['small'])->save($thumb_dir_path  . DS . 'small_'  . $filename);
        Image::open($save_path)->thumb($thumb_config['medium']  , $thumb_config['medium'])->save($thumb_dir_path . DS . 'medium_' . $filename);
        Image::open($save_path)->thumb($thumb_config['big']     , $thumb_config['big'])->save($thumb_dir_path    . DS . 'big_'    . $filename);
        
        $data = ['name' => $filename, 'path' => $picture_dir_name. SYS_DS_PROS . $filename, 'sha1' => $sha1];
        
        $result = self::$pictureModel->addInfo($data);
        
        $this->checkStorage($result);
        
        if ($result) : $data['id'] = $result; return $data; endif;
        
        return  false;
    }
    
    /**
     * 文件上传
     */
    public function fileUpload($name = 'file')
    {
        
        $object_info = request()->file($name);
        
        $sha1  = $object_info->hash();
        
        $file_info = self::$fileModel->getInfo(['sha1' => $sha1], 'id,name,path,sha1');
        
        if (!empty($file_info)) : return $file_info; endif;
        
        $object = $object_info->move(PATH_FILE);
        
        $save_name = $object->getSaveName();
        
        $file_dir_name = substr($save_name, 0, strrpos($save_name, DS));
        
        $filename = $object->getFilename();
        
        $data = ['name' => $filename, 'path' => $file_dir_name. SYS_DS_PROS . $filename, 'sha1' => $sha1];
        
        $result = self::$fileModel->addInfo($data);
        
        $this->checkStorage($result, 'uploadFile');
        
        if ($result) : $data['id'] = $result; return $data; endif;
        
        return  false;
    }
    
    /**
     * 云存储
     */
    public function checkStorage($result = 0, $method = 'uploadPicture')
    {
        
        $storage_driver = config('storage_driver');
        
        if (empty($storage_driver)) : return false; endif;
        
        $StorageModel = model('Storage', LAYER_SERVICE_NAME);

        $StorageModel->setDriver($storage_driver);

        $storage_result = $StorageModel->$method($result);
        
        $method != 'uploadPicture' ? self::$fileModel->setFieldValue(['id' => $result], 'url', $storage_result) : self::$pictureModel->setFieldValue(['id' => $result], 'url', $storage_result);
    }
    
}
