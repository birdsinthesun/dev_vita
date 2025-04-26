<?php
use Bits\DevVitaBundle\Module\ModuleProjectlist;

$GLOBALS['BE_MOD']['content']['dev_vita'] = array
(

			'tables'      => array('tl_dev_vita')
		);
$GLOBALS['FE_MOD']['dev_vita']['projectlist'] = ModuleProjectlist::class;