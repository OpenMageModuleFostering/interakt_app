<?php
/**
* 
*/
class Interakt_App_Block_Adminhtml_System_Config_Form_Button extends Mage_Adminhtml_Block_System_Config_Form_Field
{

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->setElement($element);
        //$url = $this->getUrl('catalog/product'); //

        $html = $this->getLayout()->createBlock('adminhtml/widget_button')
                    ->setId('sync_btn')
                    ->setType('button')
                    ->setClass('scalable')
                    ->setLabel($this->helper('adminhtml')->__('Sync User'))
                    ->toHtml();

        return $html;
    }
}