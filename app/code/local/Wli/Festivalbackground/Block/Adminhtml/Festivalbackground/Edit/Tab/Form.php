<?php
class Wli_Festivalbackground_Block_Adminhtml_Festivalbackground_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('festivalbackground_form', array('legend'=>Mage::helper('festivalbackground')->__('Background information')));

         $URLID=$this->getRequest()->getParam('id');
    $_edited_banner = Mage::getModel('festivalbackground/festivalbackground')->load($URLID);
    $_edited_banner = ($_edited_banner->getdata());
    $type=$_edited_banner['type'];
    $bimg="";
    $bcolor="";
    if($type==1)
    {
        $bimg='<div style="padding-top:5px;padding-bottom:5px" id="imagetag"><img src="'.Mage::getBaseUrl('media') . 'festivalbackground'.DS.$_edited_banner['background'].'" width=250px height=250/></div>';
    }
    else
    {
        $bcolor='<div style="padding-top:5px;padding-bottom:5px;width:30px;height:30px; background-color:'.$_edited_banner['background'].'" ></div>';
    }

        $fieldset->addField('festivalname', 'text', array(
            'label'     => Mage::helper('festivalbackground')->__('Festival Name'),
            'class'     => 'required-entry',
            'required'  => true,
            'name'      => 'festivalname',
            
        ));

	$fieldset->addField('startdate', 'date', array(
            'label'     => Mage::helper('festivalbackground')->__('Start Date'),
             'class'     => 'required-entry validate-date',
            'required'  => true,
            'name'      => 'startdate',
            'format' => 'yyyy-MM-dd', 
            'label' => Mage::helper('festivalbackground')->__('Start Date'), 
	    'image' => $this->getSkinUrl('images/grid-cal.gif')
        ));


	$fieldset->addField('enddate', 'date', array(
            'label'     => Mage::helper('festivalbackground')->__('End Date'),
            'class'     => 'required-entry validate-date',
            'required'  => true,
            'name'      => 'enddate',
            'format' => 'yyyy-MM-dd',
            'label' => Mage::helper('festivalbackground')->__('End Date'), 
	    'image' => $this->getSkinUrl('images/grid-cal.gif')
        ));

	$fieldset->addField('type', 'radios', array(
          'label'     => Mage::helper('festivalbackground')->__('Background Type'),
          'name'      => 'type',
          'values' => array(
                            array('id'=>'image','value'=>'1','label'=>'Image'),
                            array('id'=>'color','value'=>'2','label'=>'Color'),
                       ),
           
        ));
        
        $fieldset->addField('backgroundcolor', 'text', array(
            'label'     => Mage::helper('festivalbackground')->__('Background Color'),
            'name'      => 'backgroundcolor',
            'class'     => 'color {required:false, adjust:false, hash:true}',
            'after_element_html' => $bcolor,
            
        ));
        
        
        $fieldset->addField('backgroundimage', 'file', array(
            'label'     => Mage::helper('festivalbackground')->__('Background Image'),
            'name'      => 'backgroundimage',
            'after_element_html' =>$bimg,
            
            
        ));
        
        
     
        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('festivalbackground')->__('Status'),
            'name'      => 'status',
            'class'     => 'required-entry',
            'required'  => true,
            'values'    => array(
                array(
                    'value'     => 1,
                    'label'     => Mage::helper('festivalbackground')->__('Active'),
                ),
  
                array(
                    'value'     => 0,
                    'label'     => Mage::helper('festivalbackground')->__('Inactive'),
                ),
            ),
        ));
        
        
        
        if ( Mage::getSingleton('adminhtml/session')->getFestivalbackgroundData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getFestivalbackgroundData());
            Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData(null);
        } elseif ( Mage::registry('festivalbackground_data') ) {
            $form->setValues(Mage::registry('festivalbackground_data')->getData());
        }
        return parent::_prepareForm();
    }
}
