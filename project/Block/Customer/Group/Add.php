<?php

namespace Block\Customer\Group;

class Add extends \Block\Core\Component\Form{

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Customer Group';
        $this->setModel('\Model\Customer\Group');
        $this->formFields = 
        [
            'name' => 
                [
                    'label' => 'Name',
                    'type' => 'text',
                    'required' => 'true'
                ],
            'sortOrder' => 
                [
                    'label' => 'Sort Order',
                    'type' => 'text',
                    'required' => 'true',
            ]
        ];
        $this->setFormFields($this->formFields);
        
    }
}

?>