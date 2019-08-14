<?php
/**
* 
*/
class Interakt_App_Helper_Data extends Mage_Core_Helper_Abstract
{
	const XML_PATH_APP_ID = 'interakt_app/settings/app_id';
	const XML_PATH_API_KEY = 'interakt_app/settings/api_key';
	public function getAppId($store=null)
	{
		return Mage::getStoreConfig(self::XML_PATH_APP_ID,$store);
	}
	public function getApiKey($store=null)
	{
		return Mage::getStoreConfig(self::XML_PATH_API_KEY,$store);
	}
}
?>