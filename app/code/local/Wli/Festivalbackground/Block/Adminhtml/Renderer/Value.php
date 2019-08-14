<?php
class Wli_Festivalbackground_Block_Adminhtml_Renderer_Value extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
        public function render(Varien_Object $row)	
	{
	        $data =  $row->getData($this->getColumn()->getIndex());
	        $id=$row->getData();
	        
	        if($id['type']==1)
	        {
	                return "Image";      
	        }
	        
	        else
	        {
	                return "Color";
	        }
	        
	}
}

