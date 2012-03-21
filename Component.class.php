<?php
/**
 * Component class.
 *
 * @author  Tatiana Vakulenko <tvakulenko@gmail.com>
 * @package packageName
 * @since 1.0
 *
 */

/**
 * Component class.
 *
 * Description of Component class
 */

require_once 'Input.class.php';
require_once 'Select.class.php';
require_once 'Textarea.class.php';

class Component
{   
    public static function createComponent($element)
    {
        $obj = null;

        $element = ucfirst(strtolower($element));

        $obj = new $element;
        return $obj;
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
