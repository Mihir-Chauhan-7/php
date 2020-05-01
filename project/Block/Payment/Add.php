<?php

namespace Block\Payment;

class Add extends \Block\Core\Component\Form{

    protected $paymentmethod = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->title = 'Payment Method';
        $this->paymentMethod = \Ccc::objectManager('\Model\Payment\Method',true);
        $this->setModel('\Model\Payment\Method');
        $this->formFields = 
        [
            'name' => 
                [
                    'label' => 'Name',
                    'type' => 'text',
                    'required' => 'true'
                ],
            'status' => 
                [
                    'label' => 'Status',
                    'type' => 'dropdown',
                    'required' => 'true',
                    'data' => [
                        'options' => 'getStatusOptions'
                    ]           
            ]
        ];

        $this->setFormFields($this->formFields);
    }
}

?>