<?php

use Magento\Framework\App\Bootstrap;
 
require __DIR__ . '/../app/bootstrap.php';
 
$params = $_SERVER;
 
$bootstrap = Bootstrap::create(BP, $params);
 
$obj = $bootstrap->getObjectManager();
 
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
 
//$product = $obj->get('Magentomaster\Marketplace\Model\Vendors')->load(1);
?>

