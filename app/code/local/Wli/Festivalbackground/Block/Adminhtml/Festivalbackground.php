<?php
  
class Wli_Festivalbackground_Block_Adminhtml_Festivalbackground extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_festivalbackground';
        $this->_blockGroup = 'festivalbackground';
        $this->_headerText = Mage::helper('festivalbackground')->__('Background Manager');
        $this->_addButtonLabel = Mage::helper('festivalbackground')->__('Add Background');
        parent::__construct();
    }
}
