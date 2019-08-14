<?php
  
class Wli_Festivalbackground_Block_Adminhtml_Festivalbackground_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                
        $this->_objectId = 'id';
        $this->_blockGroup = 'festivalbackground';
        $this->_controller = 'adminhtml_festivalbackground';
  
        $this->_updateButton('save', 'label', Mage::helper('festivalbackground')->__('Save Background'));
        $this->_updateButton('delete', 'label', Mage::helper('festivalbackground')->__('Delete Background'));
    }
  
    public function getHeaderText()
    {
        if( Mage::registry('festivalbackground_data') && Mage::registry('festivalbackground_data')->getId() ) {
            return Mage::helper('festivalbackground')->__("Edit Background %s", $this->htmlEscape(Mage::registry('festivalbackground_data')->getTitle()));
        } else {
            return Mage::helper('festivalbackground')->__('Add Background');
        }
    }
}
