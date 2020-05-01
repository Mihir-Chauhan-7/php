<?php


class Cybercom_Vendor_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{

    protected function _initVendor($idFieldName = 'id')
    {
        $this->_title($this->__('Vendors'))->_title($this->__('Manage Vendors'));

        $vendorId = (int) $this->getRequest()->getParam($idFieldName);
        $vendor = Mage::getModel('vendor/vendor');

        if ($vendorId) {
            $vendor->load($vendorId);
        }

        Mage::register('current_vendor', $vendor);
        return $this;
    }

    public function indexAction()
    {

        $this->loadLayout();
        $this->_setActiveMenu('vendor');
        $this->_title($this->__("Manage Vendor"));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_initVendor();
        $vendor = Mage::registry('current_vendor');
        $this->loadLayout();
        $this->_setActiveMenu('vendor');
        $this->_addContent($this->getLayout()->createBlock(
            'vendor/adminhtml_Index_edit'));
        $this->renderLayout();  
    }

    public function saveAction(){
        if ( $this->getRequest()->getPost() ) {
            try {
                $postData = $this->getRequest()->getPost();
                $vendor = Mage::getModel('vendor/vendor');

                $vendor->setId($this->getRequest()->getParam('id'))
                    ->setName($postData['Name'])
                    ->save();

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
        $this->_initVendor();
        $vendor = Mage::registry('current_vendor');
        if ($vendor->getId()) {
            try {
                $vendor->load($vendor->getId());
                $vendor->delete();
            }
            catch (Exception $e){
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/adminhtml_index');
    }

    public function massDeleteAction(){
        $vendorIds = $this->getRequest()->getParam('vendor');
        if(!is_array($vendorIds)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Please select customer(s).'));
        } else {
            try {
                foreach ($vendorIds as $vendorId) {
                    $vendor = Mage::getModel('vendor/vendor')
                        ->load($vendorId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vendor')->__('Total of %d record(s) were deleted.', count($vendorIds))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
        
        
    }

}
