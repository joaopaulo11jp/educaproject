<?php
Namespace Adianti\Widget\Wrapper;

use Adianti\Core\AdiantiCoreTranslator;
use Adianti\Widget\Base\TElement;
use Adianti\Widget\Base\TScript;
use Adianti\Widget\Form\TEntry;
use Adianti\Database\TCriteria;

use Exception;

/**
 * Database Entry Widget
 *
 * @version    2.0
 * @package    widget
 * @subpackage wrapper
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2014 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TDBEntry extends TEntry
{
    protected $minLength;
    private $database;
    private $model;
    private $column;
    private $operator;
    private $orderColumn;
    private $criteria;
    
    /**
     * Class Constructor
     * @param  $name     widget's name
     * @param  $database database name
     * @param  $model    model class name
     * @param  $value    table field to be listed in the combo
     * @param  $ordercolumn column to order the fields (optional)
     * @param  $criteria criteria (TCriteria object) to filter the model (optional)
     */
    public function __construct($name, $database, $model, $value, $orderColumn = NULL, TCriteria $criteria = NULL)
    {
        // executes the parent class constructor
        parent::__construct($name);
        
        if (empty($database))
        {
            throw new Exception(AdiantiCoreTranslator::translate('The parameter (^1) of ^2 is required', 'database', __CLASS__));
        }
        
        if (empty($model))
        {
            throw new Exception(AdiantiCoreTranslator::translate('The parameter (^1) of ^2 is required', 'model', __CLASS__));
        }
        
        if (empty($value))
        {
            throw new Exception(AdiantiCoreTranslator::translate('The parameter (^1) of ^2 is required', 'value', __CLASS__));
        }
        
        $this->minLength = 1;
        $this->database = $database;
        $this->model = $model;
        $this->column = $value;
        $this->operator = 'like';
        $this->orderColumn = isset($orderColumn) ? $orderColumn : NULL;
        $this->criteria = $criteria;
    }
    
    /**
     * Define the minimum length for search
     */
    public function setMinLength($length)
    {
        $this->minLength = $length;
    }
    
    /**
     * Define the search operator
     * @param $operator Search operator
     */
    public function setOperator($operator)
    {
        $this->operator = $operator;
    }
    
    /**
     * Shows the widget
     */
    public function show()
    {
        parent::show();
        
        $min = $this->minLength;
        $orderColumn = isset($this->orderColumn) ? $this->orderColumn : $this->column;
        $criteria = '';
        if ($this->criteria)
        {
            $criteria = base64_encode(serialize($this->criteria));
        }
        
        $seed = APPLICATION_NAME.'s8dkld83kf73kf094';
        $hash = md5("{$seed}{$this->database}{$this->column}{$this->model}");
        $length = $this->minLength;

        $class = 'AdiantiAutocompleteService';
        $callback = array($class, 'onSearch');
        $method = $callback[1];
        $url = "engine.php?class={$class}&method={$method}&static=1&database={$this->database}&column={$this->column}&model={$this->model}&orderColumn={$orderColumn}&criteria={$criteria}&operator={$this->operator}&hash={$hash}";
        
        TScript::create(" tdbentry_start( '{$this->name}', '{$url}', '{$min}' );");
    }
}
