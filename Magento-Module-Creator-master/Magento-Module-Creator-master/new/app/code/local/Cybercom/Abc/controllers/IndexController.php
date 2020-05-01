<?php
class Cybercom_Abc_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
    	
    	/*
    	 * Load an object by id 
    	 * Request looking like:
    	 * http://site.com/abc?id=15 
    	 *  or
    	 * http://site.com/abc/id/15 	
    	 */
    	/* 
		$abc_id = $this->getRequest()->getParam('id');

  		if($abc_id != null && $abc_id != '')	{
			$abc = Mage::getModel('abc/abc')->load($abc_id)->getData();
		} else {
			$abc = null;
		}	
		*/
		
		 /*
    	 * If no param we load a the last created item
    	 */ 
    	/*
    	if($abc == null) {
			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$abcTable = $resource->getTableName('abc');
			
			$select = $read->select()
			   ->from($abcTable,array('abc_id','title','content','status'))
			   ->where('status',1)
			   ->order('created_time DESC') ;
			   
			$abc = $read->fetchRow($select);
		}
		Mage::register('abc', $abc);
		*/

			
		$this->loadLayout();     
		$this->renderLayout();
    }
}