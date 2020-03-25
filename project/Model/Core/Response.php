<?php

namespace Model\Core;

class Response{

    protected $elements = []; 

    public function setElements($elements){
      $this->elements = $elements;
      return $this;
    }
    
    public function getElements(){
      return $this->elements;
    }

    public function setBody($html){
        echo $html;
    }

    public function setHeader($header){
        header("Content-Type: $header");
        return $this;
    }

    public function getJson($html){
        $this->setHeader('application/json');
        echo $html;
    }

    public function addElement($elementId,$html){
        $elements = $this->getElements();
        $elements[] = [ 
            'elementId' => $elementId,
            'html' => $html
        ];

        $this->setElements($elements);
        return $this;
    }

    public function addIdentifier($identifier,$operation,$value){
        $elements = $this->getElements();
        $elements[] = [
            'identifier' => $identifier,
            'class' => [
                $operation => $value 
            ]
        ];

        $this->setElements($elements);
        return $this;
    }

    public function generateResponse($type = 1){
        $responseType = $type ? 'success' : 'failed';
        $responseData = [
            'responseType' => $responseType,
            'elements' => $this->getElements()
        ];
        return $responseData;
    }
}
?>