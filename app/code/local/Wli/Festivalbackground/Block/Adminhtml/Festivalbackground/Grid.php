<?php
class Wli_Festivalbackground_Block_Adminhtml_Festivalbackground_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('festivalbackgroundGrid');
        // This is the primary key of the database
        $this->setDefaultSort('festivalbackground_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
  
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('festivalbackground/festivalbackground')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
        
    }
  
    
  
  
    protected function _prepareColumns()
    {
        $this->addColumn('festivalbackground_id', array(
            'header'    => Mage::helper('festivalbackground')->__('ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'festivalbackground_id',
        ));
  
        $this->addColumn('festivalname', array(
            'header'    => Mage::helper('festivalbackground')->__('Festival Name'),
            'align'     =>'left',
            'index'     => 'festivalname',
        ));
  

	$this->addColumn('startdate', array(
            'header'    => Mage::helper('festivalbackground')->__('Start Date'),
            'align'     =>'left',
            'index'     => 'startdate',
        ));
        
        $this->addColumn('enddate', array(
            'header'    => Mage::helper('festivalbackground')->__('End Date'),
            'align'     =>'left',
            'index'     => 'enddate',
        ));

        $this->addColumn('type', array(
            'header'    => Mage::helper('festivalbackground')->__('Background Type'),
            'align'     =>'left',
            'index'     => 'type',
            'renderer'  => 'Wli_Festivalbackground_Block_Adminhtml_Renderer_Value',          
            
        ));	
       
            $this->addColumn('background', array(
            'header'    => Mage::helper('festivalbackground')->__('Background Image/Color Code'),
            'align'     =>'left',
            'index'     => 'background',
	    'renderer'  => 'Wli_Festivalbackground_Block_Adminhtml_Renderer_Backgroundimg',
             ));    
       
  
        $this->addColumn('status', array(
  
            'header'    => Mage::helper('festivalbackground')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
  
        return parent::_prepareColumns();
    }
 
             
     
  
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
  
    public function getGridUrl()
    {
      return $this->getUrl('*/*/grid', array('_current'=>true));
    }
  
    protected function _prepareMassaction()
    {
                $this->setMassactionIdField('id');
                $this->getMassactionBlock()->setFormFieldName('id');
                 
                $this->getMassactionBlock()->addItem('delete', array(
                'label'=> Mage::helper('festivalbackground')->__('Delete'),
                'url'  => $this->getUrl('*/*/massDelete', array('' => '')),        
                'confirm' => Mage::helper('festivalbackground')->__('Are you sure?')
                ));
                 
                return $this;
    }
}
