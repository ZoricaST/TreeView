
<?php

// get the q parameter from URL
$q = $_REQUEST["q"]; 

require_once 'myTreeView.class.php';
require_once 'abstractTreeView.class.php';

 $myAjax = new myTreeView();
 //$c=0;
  $result = $myAjax->fetchAjaxTreeNode($q);
  echo $result;
			
									
?> 