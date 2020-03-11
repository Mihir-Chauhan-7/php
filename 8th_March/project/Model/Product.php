<?php

namespace Model;

use Model\Core\Row;
use Model\Product\Image;

class Product extends Row{
    protected $acceptedTypes = ['png' => 'image/png',
    'jpeg' => 'image/jpeg',
    'jpg' => 'image/jpeg',
    'gif' => 'image/gif',
    'bmp' => 'image/bmp'];


    const STATUS_ENABLE = 1;
    const STATUS_ENABLE_LABEL = 'Enable';
    const STATUS_DISABLE = 0;
    const STATUS_DISABLE_LABEL = 'Disable';

    protected $statusOptions = [
        self::STATUS_ENABLE => self::STATUS_ENABLE_LABEL,
        self::STATUS_DISABLE => self::STATUS_DISABLE_LABEL
    ];

    protected $directory = 'media\catalog\product\\';
    protected $tableName = 'products';
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);        
    }    

    public function setDirectory($directory){
        $this->directory = $directory;
        return $this;
    }

    public function getDirectory(){
        return $this->directory;
    }

    public function getStatusOptions(){
        return $this->statusOptions;
    }

    public function uploadImage($file){
        try{
            $uploadDirectory = \Ccc::getBaseDirectory($this->getDirectory());
            $name = $file['image']['name'];

            if(!in_array(mime_content_type($file['image']['tmp_name']),$this->acceptedTypes)){
                throw new \Exception("Invalid File Type");
                return false;
            }
    
            if(!move_uploaded_file($file['image']['tmp_name'],$uploadDirectory.$name)){
                throw new \Exception("Unable To Upload Image.");
                return false;
            }

            $imageModel = new Image();
            $imageModel->setData(['productId' => $this->id,
                'name' => $file['image']['name']]);
            
            $imageModel->saveData();

            return $imageModel;
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}