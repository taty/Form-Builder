<?php

/**
 * FormBuilder class.
 *
 * @author  Tatiana Vakulenko <tvakulenko@gmail.com>
 * @package packageName
 * @since 1.0
 *
 */

/**
 * FormBuilder class.
 *
 * Description of FormBuilder class
 */

require_once 'Component.class.php';

class FormBuilder 
{           

    public function getObjFromXml($xml) 
    {
        if (file_exists($xml)) 
        {
            $obj = simplexml_load_file($xml);
            return $obj;
        }
        return false;
    }

    public function buildForm($obj) 
    {       
        require_once 'header.php';
        $form = $obj->form;
        echo "<form name='". $form->name."' method='".$form->method."'
                action='".$form->action. "' enctype='".$form->enctype."' >";
        $str = '';
        foreach($form->item as $item){
            if (isset($item->label))
            {
                $str .= $this->createLabel($item);
            }
            if(isset($item->elem))
            {
                $elem = Component::createComponent($item->elem);
                $str .= $elem->createElement($form->name, $item);                
            }
            else
            {
                throw new Exception('Item in xml file doesn\'t have elem tag!');
            }
            $str .= $this->createErrorElement($form->name, $item);
            
            $str .=  '<br>';
            
        }
        echo $str."</form>";
        require_once 'footer.php';
    }
    
    protected function createLabel($item)
    {
        $str = '<label for="'.$item->id.'">' . $item->label.'</label>';
        if (substr_count($item->class, 'required') > 0)
        {
            $str .= '<em>*</em>';
        }
        else
        {
            $str .= '<em>&nbsp;</em>';
        }
        return $str;
    }
    
    protected function createErrorElement($formName, $item)
    {
        if (substr_count($item->class, 'required') > 0)
        {
            return '<span class="error_'.$formName.'_'.$item->name.'"></span>';
        }
    }


}
?>

