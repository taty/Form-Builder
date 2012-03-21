<?php
/**
 * Select class.
 *
 * @author  Tatiana Vakulenko <tvakulenko@gmail.com>
 * @package packageName
 * @since 1.0
 *
 */

/**
 * Select class.
 *
 * Description of Select class
 */
class Select extends Component
{
    public $avalibleSelectAttrs = array(
        'id', 'class', 'name', 'required', 'disabled', 'multiple', 'size'
    );
    
    public function createElement($formName, $attrs)
    {
        $str = "<select ". $this->checkExistAttr($formName, $attrs)." >";
        foreach ($attrs->option as $opt)
        {
            $selected = '';
            if($opt->selected)
            {
                $selected .= 'selected';
            }
            $str .= "<option value='" . $opt->value . "' ".$selected.">" . $opt->text . "</option>";
        }
        $str .= "</select>";
        return $str;
    }
}

?>
