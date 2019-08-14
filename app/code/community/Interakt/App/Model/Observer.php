<?php
class Interakt_App_Model_Observer
{
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
