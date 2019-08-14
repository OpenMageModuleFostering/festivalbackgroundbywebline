<?php
class Wli_Festivalbackground_Model_Mysql4_Festivalbackground extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {   
        $this->_init('festivalbackground/festivalbackground', 'festivalbackground_id');
    }
}
