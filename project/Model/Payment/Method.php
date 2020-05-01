<?php

namespace Model\Payment;

class Method extends \Model\Core\Row{

    protected $tableName = 'payment_method';
    protected $primaryKey = 'methodId';
    protected $formFields = [];

    
    const STATUS_ENABLE = 1;
    const STATUS_ENABLE_LABEL = 'Enable';
    const STATUS_DISABLE = 0;
    const STATUS_DISABLE_LABEL = 'Disable';

    protected $statusOptions = [
        self::STATUS_ENABLE => self::STATUS_ENABLE_LABEL,
        self::STATUS_DISABLE => self::STATUS_DISABLE_LABEL
    ];

    public function __construct()
    {   
        parent::__construct();
        $this->setTable($this->tableName)->setPrimaryKey($this->primaryKey);
    }

    public function getStatusLabel(){
        return key_exists($this->status,$this->statusOptions) ? $this->statusOptions[$this->status] : NULL;
    }

    public function getStatusOptions(){
        return $this->statusOptions;
    }

}
?>


