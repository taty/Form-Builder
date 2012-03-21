<?php
/**
 * Textarea class.
 *
 * @author  Tatiana Vakulenko <tvakulenko@gmail.com>
 * @package packageName
 * @since 1.0
 *
 */

/**
 * Textarea class.
 *
 * Description of Textarea class
 */
class Textarea extends Component
{
    public $avalibleTextareaAttrs = array(
        'id', 'class', 'name', 'cols', 'rows', 'required', 'disabled', 'readonly'
    );

    public function createElement($formName, $attrs)
    {
        return "<textarea".$this->checkExistAttr($formName, $attrs)." >" . $attrs->value . "</textarea>";
    }
}

?>
