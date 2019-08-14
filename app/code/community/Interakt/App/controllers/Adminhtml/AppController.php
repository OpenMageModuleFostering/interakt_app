<?php
class Interakt_App_Adminhtml_AppController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Return some checking result
     *
     * @return void
     */
    
    public function indexAction()
    {
        $sync_users=Mage::getModel('Interakt_App_Model_SyncUserData');
        $count=$sync_users->userCount();
        echo $count;
    }
    public function syncdataAction()
    {
        $offset=isset($_GET['offset'])?$_GET['offset']:"";
        $sync_users=Mage::getModel('Interakt_App_Model_SyncUserData');
        $data=$sync_users->syncData($offset);
        echo $data;
    }

}
?>