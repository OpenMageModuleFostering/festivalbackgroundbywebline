<?php
  
$installer = $this;
  
$installer->startSetup();
  
$installer->run("
  
-- DROP TABLE IF EXISTS {$this->getTable('festivalbackground')};
CREATE TABLE {$this->getTable('festivalbackground')} (
  `festivalbackground_id` int(11) unsigned NOT NULL auto_increment,
  `festivalname` varchar(255) NOT NULL default '',
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL, 
  `type` smallint(1) NOT NULL,
  `background` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL default '0',
  `created_time` datetime NULL,
  `update_time` datetime NULL,
  PRIMARY KEY (`festivalbackground_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  
    ");
  
$installer->endSetup();
