<?php
/**
 * Smarty plugin
 *
 * @package    Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {html_options} function plugin
 * Type:     function<br>
 * Name:     html_options<br>
 * Purpose:  Prints the list of <option> tags generated from
 *           the passed parameters<br>
 * Params:
 * <pre>
 * - name       (optional) - string default "select"
 * - values     (required) - if no options supplied) - array
 * - options    (required) - if no values supplied) - associative array
 * - selected   (optional) - string default not set
 * - output     (required) - if not options supplied) - array
 * - id         (optional) - string default not set
 * - class      (optional) - string default not set
 * </pre>
 *
 * @link     http://www.smarty.net/manual/en/language.function.html.options.php {html_image}
 *           (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @author   Ralf Strehle (minor optimization) <ralf dot strehle at yahoo dot de>
 *
 * @param array $params parameters
 *
 * @return string
 * @uses     smarty_function_escape_special_chars()
 */
function smarty_function_menuetreeXXXXXXX($params)
{
    return print_r($params, true);
}
