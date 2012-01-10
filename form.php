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
} else {
    throw new Exception('You must recieve xml object');
}

?>