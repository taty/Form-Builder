<?php

require_once 'FormBuilder.php';

$xml = 'form.xml';
$form = new FormBuilder();
$obj = $form->getObjFromXml($xml);
if (is_object($obj)) {
    $data = $form->buildForm($obj);
    
    
} else {
    throw new Exception('You must recieve xml object');
}

?>