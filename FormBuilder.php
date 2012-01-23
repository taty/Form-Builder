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
        foreach ($obj->item as $item) 
        {
            if (isset($item->label)) 
            {
                echo '<label for="'.$item->id.'">' . $item->label.'</label>';
                if (substr_count($item->class, 'required') > 0)
                {
                    echo '<em>*</em>';
                }
                else{
                    echo '<em>&nbsp;</em>';
                }
            }
           
            $render = 'render' . ucfirst($item->elem);
            $this->$render($item);
            echo '<br>';
        }
        echo "</form>";
        require_once 'footer.php';
    }

    protected function renderInput($attrs) 
    {
        echo "<input ". $this->checkExistAttr($attrs)." >";

    }

    protected function renderTextarea($attrs) 
    {
        echo "<textarea".$this->checkExistAttr($attrs)." >" . $attrs->value . "</textarea>";
    }

    protected function renderSelect($attrs) 
    {
        echo "<select ". $this->checkExistAttr($attrs)." >";
        foreach ($attrs->option as $opt) 
        {
            echo "<option value='" . $opt->value . "'>" . $opt->text . "</option>";
        }
        echo "</select>";
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

