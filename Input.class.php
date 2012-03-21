<?php

/**
 * Input class.
 *
 * @author  Tatiana Vakulenko <tvakulenko@gmail.com>
 * @package packageName
 * @since 1.0
 *
 */

/**
 * Input class.
 *
 * Description of Input class
 */

class Input extends Component
{
    public $avalibleInputAttrs = array(
        'id', 'class', 'name', 'type', 'value', 'placeholder', 'required', 'size',
        'src', 'align', 'disabled', 'readonly', 'checked'
    );

    public function createElement($formName, $attrs)
    {
        return "<input ". $this->checkExistAttr($formName, $attrs)." >";
    }

}

?>
