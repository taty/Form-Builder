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
class FormBuilder 
{
    public $avalibleInputAttrs = array(
        'id', 'class', 'name', 'type', 'value', 'placeholder', 'required', 'size',
        'src', 'align', 'disabled', 'readonly', 'checked'
    );
    public $avalibleTextareaAttrs = array(
        'id', 'class', 'name', 'cols', 'rows', 'required', 'disabled', 'readonly'
    );
    public $avalibleSelectAttrs = array(
        'id', 'class', 'name', 'required', 'disabled', 'multiple', 'size'
    );

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
        foreach($obj->form as $form){
            echo "<form name='" . $form->name . "' method='" . $form->method . "'
            action='" . $form->action . "' enctype='".$form->enctype."' >".$this->buildItems($form->name, $form->item)."</form>";
        }
        require_once 'footer.php';
    }
    public function buildItems($formName, $items)
    {
        $str = '';
        foreach ($items as $key => $item)
        {
            if (isset($item->label))
            {
                $str .= '<label for="'.$item->id.'">' . $item->label.'</label>';
                if (substr_count($item->class, 'required') > 0)
                {
                    $str .= '<em>*</em>';
                }
                else
                {
                    $str .= '<em>&nbsp;</em>';
                }
            }
            if(isset($item->elem))
            {
                $render = 'render' . ucfirst($item->elem);
                $str .= $this->$render($formName, $item);
            }
            else
            {
                foreach($item->item as $val)
                {
                    $render = 'render' . ucfirst($val->elem);
                    $str .= $this->$render($formName, $val);
                }
                    
            }
            if (substr_count($item->class, 'required') > 0)
            {
                    $str .= '<span class="error_'.$formName.'_'.$item->name.'"></span>';
            }
            $str .=  '<br>';
        }
        return $str;
    }

    protected function renderInput($formName, $attrs)
    {
        return "<input ". $this->checkExistAttr($formName, $attrs)." >";

    }

    protected function renderTextarea($formName, $attrs)
    {
        return "<textarea".$this->checkExistAttr($formName, $attrs)." >" . $attrs->value . "</textarea>";
    }

    protected function renderSelect($formName, $attrs)
    {
        $str = "<select ". $this->checkExistAttr($formName, $attrs)." >";
        foreach ($attrs->option as $opt) 
        {
            $selected = '';
            if($opt->selected){
                $selected .= 'selected';
            }
            $str .= "<option value='" . $opt->value . "' ".$selected.">" . $opt->text . "</option>";
        }
        $str .= "</select>";
        return $str;
    }

    protected function checkExistAttr($formName, $attrs)
    {
        $avalibleAttrs = 'avalible' . ucfirst($attrs->elem) . 'Attrs';
        $str = '';
        foreach ($attrs as $key => $val) 
        {
            if (in_array($key, $this->$avalibleAttrs)) 
            {
                if($key == 'name')
                {
                   $val = $formName."_".$val;
                }
                $str .= ' ' . $key . "='" . $val . "' ";
            }
        }
        return $str;
    }    

}
?>

