<?php
class Wli_Festivalbackground_Adminhtml_FestivalbackgroundController extends Mage_Adminhtml_Controller_Action
{
  
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('festivalbackground/items')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        return $this;
    }   
    
    public function indexAction() {
        $this->_initAction();       
        $this->_addContent($this->getLayout()->createBlock('festivalbackground/adminhtml_festivalbackground'));
        $this->renderLayout();
    }
   
    public function editAction()
    {
        $festivalbackgroundId     = $this->getRequest()->getParam('id'); 
        $festivalbackgroundModel  = Mage::getModel('festivalbackground/festivalbackground')->load($festivalbackgroundId);
       
        if ($festivalbackgroundModel->getId() || $festivalbackgroundId == 0) {
  
            Mage::register('festivalbackground_data', $festivalbackgroundModel);
  
            $this->loadLayout();
            $this->_setActiveMenu('festivalbackground/items');
            
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Festivalbackground Manager'), Mage::helper('adminhtml')->__('Festivalbackground Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Festivalbackground News'), Mage::helper('adminhtml')->__('Festivalbackground News'));
            
            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
            
            $this->_addContent($this->getLayout()->createBlock('festivalbackground/adminhtml_festivalbackground_edit'))
                 ->_addLeft($this->getLayout()->createBlock('festivalbackground/adminhtml_festivalbackground_edit_tabs'));
                
            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('festivalbackground')->__('Festivalbackground does not exist'));
            $this->_redirect('*/*/');
        }
    }
    
    
    
    
    public function newAction()
    {
        $this->_forward('edit');
    }
   
    
    public function saveAction()
    {
        $id= $this->getRequest()->getParam('id'); 
        if ( $this->getRequest()->getPost() ) 
        {
            try
             {
                $postData = $this->getRequest()->getPost();
                $festivalbackgroundModel = Mage::getModel('festivalbackground/festivalbackground');
            
                if($postData['type']==1)
                {
                        $background=$_FILES['backgroundimage']['name'];
                }
                else
                {
                	$background=$postData['backgroundcolor'];
                }
                
                
                // Start date and enddate must be >= today
                $today= date("Y-m-d");
                if($postData['startdate'] >= $today && $postData['enddate'] >= $today)
                {
                	// start date always <= to end date                	
	                if($postData['startdate'] <= $postData['enddate'])
	                {
	                 // Duplicate start date and enddate not allowed.... Code start... 
                
		           $collection = Mage::getModel('festivalbackground/festivalbackground')->getCollection();
		           $collection->getSelect()
		           ->reset(Zend_Db_Select::COLUMNS)
		           ->columns('startdate')
		           ->columns('festivalbackground_id')
		           ->columns('enddate');
		          
		           $collection=$collection->getData();
			   foreach($collection as $row)
			   {
			        if($id!='' && $id==$row['festivalbackground_id'])
			        {
			                continue;
			        }
			        $dsd=strtotime($row['startdate']);
			        $dsd = date('Y-m-d',$dsd);
			        $ded=strtotime($row['enddate']);
			        $ded = date('Y-m-d',$ded);
                                $psd  = date('Y-m-d',strtotime($postData['startdate']));
			        $ped=date('Y-m-d',strtotime($postData['enddate'])); 
			        if((($psd >= $dsd && $psd<= $ded) || ($ped <= $ded && $ped >= $dsd)))
			        {
			                if($id!='' && $dsd==$psd && $ded==$ped)
			                {
			                }
			                else
			                {
			                        Mage::getSingleton('core/session')->addError('Slot Booked..'); 
			          	        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			          	        return false;
			          	}
			        }
			        elseif(($dsd >= $psd && $ded <= $ped))
			        {
			                if($id!='' && $dsd==$psd && $ded==$ped)
			                {
			                }
			                else
			                {
			                        Mage::getSingleton('core/session')->addError('Slot Booked..'); 
			                        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			                        return false;
			                }
			        }
			        else
			        {
			        }
			  }
             
              
                // Duplicate start date and enddate not allowed.... Code End...
                
                        if(isset($_FILES['backgroundimage']['name']) && $_FILES['backgroundimage']['name'] != '')
                        {
                                try
                                {
                                        if($this->getRequest()->getParam('id'))
                                        {
                                                $festivalbackgroundModel->load($this->getRequest()->getParam('id'));
                                                if($festivalbackgroundModel->getImage())
                                                {
                                                        $this->removeRequiredImages($festivalbackgroundModel->getImage());
                                                }
                                        }
                                    /* Upload Image Code Start */
                                    $fileName 		=$_FILES['backgroundimage']['name'];
                                    $filesize		=$_FILES['backgroundimage']['size'];
                                    $fileExt        = strtolower(substr(strrchr($fileName, "."), 1));
                                    $fileNamewoe    = rtrim($fileName, $fileExt);
                                    $fileName       = str_replace(' ', '', $fileNamewoe) . $fileExt;
                                    
                                    $uploader       = new Varien_File_Uploader('backgroundimage');
                                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); //allowed extensions
                                    $uploader->setAllowRenameFiles(false);
                                    $uploader->setFilesDispersion(false);
                                    $path = Mage::getBaseDir('media') . DS . 'festivalbackground';
                    
                                    if(!is_dir($path))
                                    {
                                            mkdir($path, 0777, true);
                                    }
                    
                                     $id = $this->getRequest()->getParam('id'); 
                                     $remove = Mage::getModel('festivalbackground/festivalbackground')->load($id);
                                     $remove=$remove->getData();
                                     $removeimg=$remove['background'];
                                     if($filesize > 200000)
                                     {
                                     	$uploader->save($path . DS, $fileName );
                                     	$this->removeFile($removeimg);
                                     }
                                     else
                                     {
                                     	Mage::getSingleton('adminhtml/session')->addError("Image Size should be minimum 200 KB");
                                     	//$this->_redirect('*/*/');
                                     	$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                                     	return;
                                     }
                                    /* End code for image upload */
                                }catch (Exception $e)
                                {
                                        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                                        //$this->_redirect('*/*/');
                                        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                                        return;
                                }
                        }
                                
                                $festivalbackgroundModel->setId($this->getRequest()->getParam('id'))  
                                ->setFestivalname($postData['festivalname'])
                            	->setStartdate($postData['startdate'])
                            	->setEnddate($postData['enddate'])
                            	->setType($postData['type'])
                            	->setStatus($postData['status']);
                            	if($background=='' && $id!='')
                                {
                                                        
                                }
                                else
                                {
                                      $id = $this->getRequest()->getParam('id'); 
                                      $remove = Mage::getModel('festivalbackground/festivalbackground')->load($id);
                                             $remove=$remove->getData();
                                             $removeimg=$remove['background'];
                                             $this->removeFile($removeimg);  
                                             $festivalbackgroundModel->setBackground($background);
                                }
                            	
                            	$festivalbackgroundModel->save();
		                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
                        }
                        else
                        {
                                Mage::getSingleton('core/session')->addError('Start Date should be always less then end date');
                                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    	        return; 
                        }
                        //Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData(false);
               }
                
               else
               {
                        Mage::getSingleton('core/session')->addError('Selected Date all ready passed');
                        $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                    	return; 
               }
               // Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData(false);
                //$this->_redirect('*/*/');
               //return;
        }catch (Exception $e) 
        {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFestivalbackgroundData($this->getRequest()->getPost());
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
        $this->_redirect('*/*/');
    }
    
}

public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $festivalbackgroundModel = Mage::getModel('festivalbackground/festivalbackground');
                
                $festivalbackgroundModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                    
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Festivalbackground was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('festivalbackground/adminhtml_festivalbackground_grid')->toHtml()
        );
    }
    
    public function massDeleteAction()
    {
                $fesIds = $this->getRequest()->getParam('id');     
                if(!is_array($fesIds)) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('festivalbackground')->__('Please select Festivalbackground.'));
                } else {
                try {
                $festivalbackgroundModel = Mage::getModel('festivalbackground/festivalbackground');
                foreach ($fesIds as $fesId) {
                $festivalbackgroundModel->load($fesId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('festivalbackground')->__(
                'Total of %d record(s) were deleted.', count($fesIds)
                )
                );
                } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                }
                }
                 
                $this->_redirect('*/*/index');
    }
    
    
     public function removeFile($file) 
	{
		$_helper = Mage::helper('festivalbackground');
		//$file = $_helper->updateDirSepereator($file);
		$filename = Mage::getBaseDir('media') .'/festivalbackground/'.$file ;
		if(file_exists($filename))
		{
		        $io = new Varien_Io_File();
		        $result = $io->rm($filename);
		}
	}
}
