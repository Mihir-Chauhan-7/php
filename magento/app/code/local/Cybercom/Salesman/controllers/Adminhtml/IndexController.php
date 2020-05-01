<?php


class Cybercom_Salesman_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{

    protected function _initSalesman($idFieldName = 'id')
    {
        $this->_title($this->__('Salesman'))->_title($this->__('Manage Salesman'));

        $salesmanId = (int) $this->getRequest()->getParam($idFieldName);
        $salesman = Mage::getModel('salesman/salesman');

        if ($salesmanId) {
            $salesman->load($salesmanId);
        }

        Mage::register('current_salesman', $salesman);
        return $this;
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('salesman');
        $this->_title($this->__("Manage Salesman"));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function importFormAction(){
        $this->loadLayout();
        $this->_setActiveMenu('salesman');
        $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_index_import'));
        $this->renderLayout();
    }

    public function importSaveAction(){
        try{
            $file = $_FILES['import_file'];
            
            if (!isset($file['tmp_name'])) 
                throw new Exception("Invalid File");
            if($file['type'] != 'application/vnd.ms-excel')
                throw new Exception("Invalid File Type");

            $csvfile = fopen($file['tmp_name'], 'r');
                while (($line = fgetcsv($csvfile)) !== FALSE) {
                    $salesmanData[] = $line;
            }


            fclose($csvfile);
            $fields = $salesmanData[0];
            unset($salesmanData[0]);

            

            foreach($salesmanData as $salesman){
                $salesmanObject = Mage::getModel('salesman/salesman');
                $salesmanObject->load($salesman[array_search('Email',$fields)],'email');
                $salesmanObject
                        ->setName($salesman[array_search('Name',$fields)])
                        ->setEmail($salesman[array_search('Email',$fields)])
                        ->save();
                        
                $addressData['line1'] = $salesman[array_search('Line1',$fields)];  
                $addressData['line2'] = $salesman[array_search('Line2',$fields)];
                $addressData['city'] = $salesman[array_search('City',$fields)];
                $addressData['state'] = $salesman[array_search('State',$fields)];
                $addressData['zip_code'] = $salesman[array_search('Zip_code',$fields)];
                $addressData['mobileNo'] = $salesman[array_search('MobileNo',$fields)];
                
                $salesmanObject
                    ->getAddress()
                    ->addData($addressData)->save();
            }
            $this->_redirect('*/*/');
            return;
        }
        catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/importForm');
            return;
        }
        
    }

    public function editAction()
    {
        $this->_initSalesman();
        $this->loadLayout();
        $this->_setActiveMenu('salesman');

        $this->_addContent($this->getLayout()->createBlock('salesman/adminhtml_index_edit'));
        $this->_addLeft($this->getLayout()->createBlock('salesman/adminhtml_index_edit_tabs'));
        $this->renderLayout();  
    }

    public function saveAction(){
        
        if ( $this->getRequest()->getPost() ) {
            try {
                
                $accountData = $this->getRequest()->getPost('account');
                $addressData = $this->getRequest()->getPost('address');
                
                $salesman = Mage::getModel('salesman/salesman');

                $salesman->setId($this->getRequest()->getParam('id'))
                    ->setName($accountData['Name'])
                    ->setEmail($accountData['Email'])
                    ->save();
                
                $address = $salesman->getAddress()
                    ->addData($addressData)->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setsmsnotificationData(false);

                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setsmsnotificationData($this->getRequest()->getPost());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
    }

    public function deleteAction()
    {
        $this->_initSalesman();
        $salesman = Mage::registry('current_salesman');
        if ($salesman->getId()) {
            try {
                $salesman->load($salesman->getId());
                $salesman->delete();
            }
            catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/adminhtml_index');
    }

    public function massDeleteAction(){
        $salesmanIds = $this->getRequest()->getParam('salesman');
        if(!is_array($salesmanIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Please select customer(s).'));
        } else {
            try {
                foreach ($salesmanIds as $salesmanId) {
                    $salesman = Mage::getModel('salesman/salesman')
                        ->load($salesmanId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('salesman')->__('Total of %d record(s) were deleted.', count($salesmanIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
        
        
    }

    public function exportCsvAction()
    {
        $fileName   = 'salesmans.csv';
        $content    = $this->getLayout()->createBlock('salesman/adminhtml_index_grid')
            ->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'salesmans.xml';
        $content    = $this->getLayout()->createBlock('salesman/adminhtml_index_grid')
            ->getExcelFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }

}
