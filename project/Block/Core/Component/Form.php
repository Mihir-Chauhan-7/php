<?php

namespace Block\Core\Component;

class Form extends \Block\Core\Template{

    protected $title = "";
    protected $fields = [];

    public function __construct()
    {
        $this->setTemplate('core\form.php');
    }

    public function setFormFields($fields){
      $this->fields = array_merge($this->fields,$fields) ;
      return $this;
    }
    
    public function getFormFields(){
      return $this->fields;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setModel($name){
        $this->object = \Ccc::objectManager($name,true);
    }

    public function getField($name,$fieldData){
        $required = key_exists('required',$fieldData) ? 'required' : '';
        switch($fieldData['type']){
            case 'text' :
                return '<input class="form-control" type="'.$fieldData["type"]
                    .'" name="'.$name.'" value="'.$this->object
                    ->getData($name).'" '.$required.'>';
            break;

            case 'dropdown' :
                $op = $this->object->{$fieldData['data']['options']}();
                $options = '';
                foreach($op as $id => $value){
                    $selected = $this->object->getData($name) == $id 
                        ? 'selected' 
                        : '';
                    $options .= '<option value="'.$id.'" '.$selected.'>'
                        .$value.'</option>';
                }

                return '<select class="form-control" name="'.$name.'" '
                    .$required.'>'.$options.'</select>';
            break;
        }
    }
}

?>