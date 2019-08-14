<?php
class Interakt_App_Model_Observer
{
	public function addInteraktJs($observer)
	{
		$product=Mage::getModel('Interakt_App_Model_SyncUserData');
		$product->getInteraktJs();
	}
	public function addCustomJs($observer)
	{
		$controller = $observer->getAction();
        $layout = $controller->getLayout();
        $block = $layout->createBlock('adminhtml/template');
        $block->setTemplate('interakt_app/button.phtml');  
        if(is_object($layout->getBlock('js')))              
        	$layout->getBlock('js')->append($block);
        
	}
}
?>
