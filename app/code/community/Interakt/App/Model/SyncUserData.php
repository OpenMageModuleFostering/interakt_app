<?php
/**
* 
*/
class Interakt_App_Model_SyncUserData
{
	private $interakt_app_id;
	private $interakt_api_key;
	private $user_data;
	private $total_synced=0;
	public function syncData($offset=1)
	{
		$customerData = mage::getResourceModel('customer/customer_collection')->addAttributeToSelect('firstname')
	   ->addAttributeToSelect('lastname')
	   ->addAttributeToSelect('email')->setPage($offset,30);
			foreach($customerData as $data)
			{
				$email=$data->getEmail();
				$createdAt=$data->getCreatedAt();
				$name=$data->getName();
				$this->user_data=array('email'=>$email,'name'=>$name,'created_at'=>$createdAt);
				$response=$this->sendData();
				if(isset($response)&& $response['status']=='failure')
				{
					return 'error';
				}
				$this->total_synced++;
			}
			unset($customerData);
			return json_encode($this->user_data);
	}
	public function userCount()
	{
		$userCount = mage::getResourceModel('customer/customer_collection')->count();
		return $userCount;
	}
	public function sendData()
	{
		$this->interakt_app_id=Mage::helper('interakt_app')->getAppId();
		$this->interakt_api_key=Mage::helper('interakt_app')->getApiKey();
		$this->user_data=json_encode($this->user_data);
		$url='https://app.interakt.co/api/v1/members';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl,CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
		curl_setopt($curl, CURLOPT_USERPWD, $this->interakt_app_id.':'.$this->interakt_api_key);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $this->user_data);
		$curl_response = curl_exec($curl);
		curl_close($curl);
		$curl_response=json_decode($curl_response,true);
		return $curl_response;
	}

}
?>