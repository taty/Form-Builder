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
        'src', 'align', 'disabled', 'readonly'
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
        echo "<form name='" . $obj->name . "' method='" . $obj->method . "' action='" . $obj->action . "' >";
        echo $this->buildItems($obj->item);
        echo "</form>";
        require_once 'footer.php';
    }
    public function buildItems($items)
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
                    else{
                        $str .= '<em>&nbsp;</em>';
                    }
                }
                if(isset($item->elem)){
                    $render = 'render' . ucfirst($item->elem);
                    $str .= $this->$render($item);
                }
                else
                {
                    foreach($item->item as $val)
                    {
                        $render = 'render' . ucfirst($val->elem);
                        $str .= $this->$render($val);
                    }
                }
            
            $str .=  '<br>';
        }
        return $str;
    }

    protected function renderInput($attrs) 
    {
        return "<input ". $this->checkExistAttr($attrs)." >";

    }

    protected function renderTextarea($attrs) 
    {
        return "<textarea".$this->checkExistAttr($attrs)." >" . $attrs->value . "</textarea>";
    }

    protected function renderSelect($attrs) 
    {
        $str = "<select ". $this->checkExistAttr($attrs)." >";
        foreach ($attrs->option as $opt) 
        {
            $str .= "<option value='" . $opt->value . "'>" . $opt->text . "</option>";
        }
        $str .= "</select>";
        return $str;
    }

    protected function checkExistAttr($attrs) 
    {
        $avalibleAttrs = 'avalible' . ucfirst($attrs->elem) . 'Attrs';
        $str = '';
        foreach ($attrs as $key => $val) 
        {
            if (in_array($key, $this->$avalibleAttrs)) 
            {
                $str .= ' ' . $key . "='" . $val . "' ";
            }
        }
        return $str;
    }    

}
?>

