<?php
class Wli_Festivalbackground_Block_Adminhtml_Renderer_Backgroundimg extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{	
	public function render(Varien_Object $row)	
	{
		$data =  $row->getData($this->getColumn()->getIndex());
		$id=$row->getData();
		if($id['type']==1)
		{
		        $value='<center>  <img src="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'/festivalbackground/'.$data.'" width="150" height="100" /> <br> <a href="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'/festivalbackground/'.$data.'" class="various" > Show Photo </a></center>';
		return $value;        
		}
		
		else
		{
		 $value='<div><div style="background-color:'.$id['background'].';width:15px;height:15px;float:left"></div>&nbsp;&nbsp;'.$id['background'].'</div>';
		    return $value;
		}
		
	}
}



