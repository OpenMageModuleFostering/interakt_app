<?php
class Interakt_App_Block_Display extends Mage_Core_Block_Template
{
	private $interakt_app_id;
	private $interakt_api_key;
	public function getInteraktApp()
    {
    	return Mage::helper('interakt_app')->getAppId();
    }

    public function getProtocol()
    {
    	return isset($_SERVER['HTTPS'])?'https:':'http:';
    }

    public function getLogedInCustomerDetails()
    {
    	$data = array();
    	if(Mage::getSingleton('customer/session')->isLoggedIn()){
    		$customer = Mage::getSingleton('customer/session')->getCustomer();
		  	$data['user_name']=$customer->getName();
		  	$data['email']=$customer->getEmail();
		  	$data['created_at']=$customer->getCreatedAt();
		  	return $data;
		}
		else
		{
			return false;
		}
    }

    protected function _toHtml()
    {
    	$this->interakt_app_id=Mage::helper('interakt_app')->getAppId();
    	 $block = $this->getLayout()->createBlock(
                'core/template',
                'interakt_app',
                array(
                    'template' => 'interakt_app/widget.phtml',
                    'id'=>$this->getInteraktApp(),
                    'protocol'=>$this->getProtocol(),
                    'customer'=>$this->getLogedInCustomerDetails()
                )
            );
    	 return $block->toHtml();
    }
}