<?php
  
class Wli_Festivalbackground_Block_Adminhtml_Festivalbackground_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
  
    public function __construct()
    {
        parent::__construct();
        $this->setId('festivalbackground_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('festivalbackground')->__('Background Information'));
    }
  
    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('festivalbackground')->__('Background Info'),
            'title'     => Mage::helper('festivalbackground')->__('Background Information'),
            'content'   => $this->getLayout()->createBlock('festivalbackground/adminhtml_festivalbackground_edit_tab_form')->toHtml(),
        ));
        
        return parent::_beforeToHtml();
    }
}
