<?php

require_once 'FormBuilder.php';

$xml = 'form.xml';
$form = new FormBuilder();
$obj = $form->getObjFromXml($xml);
        
if (is_object($obj)) {
    $data = $form->buildForm($obj);
    
    if (isset($_REQUEST)) {
        print "<pre>";
        var_dump($_REQUEST);
        print "</pre>";
       
    }
    //print_r($data);
     print "<pre>";
        var_dump($_FILES);
        print "</pre>";
} else {
    throw new Exception('You must recieve xml object');
}

?>