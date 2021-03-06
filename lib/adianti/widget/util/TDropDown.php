<?php
Namespace Adianti\Widget\Util;

use Adianti\Control\TAction;
use Adianti\Widget\Base\TElement;
use Adianti\Widget\Base\TScript;
use Adianti\Widget\Util\TImage;

/**
 * TDropDown Widget
 *
 * @version    2.0
 * @package    widget
 * @subpackage util
 * @author     Pablo Dall'Oglio
 * @copyright  Copyright (c) 2006-2014 Adianti Solutions Ltd. (http://www.adianti.com.br)
 * @license    http://www.adianti.com.br/framework-license
 */
class TDropDown extends TElement
{
    protected $elements;
    private $button;
    
    /**
     * Class Constructor
     * @param $title Dropdown title
     * @param $icon  Dropdown icon
     */
    public function __construct($title, $icon = NULL)
    {
        parent::__construct('div');
        $this->{'class'} = 'btn-group';
        $this->{'style'} = 'display:inline-block; -moz-user-select: none; -webkit-user-select:none; user-select:none;';
        
        $button = new TElement('button');
        $button->{'data-toggle'} = 'dropdown';
        $button->{'class'}       = 'btn btn-default btn-sm dropdown-toggle';
        $this->button = $button;
        
        $span = new TElement('span');
        $span->{'class'} = 'caret';
        
        if ($icon)
        {
            $button->add(new TImage($icon));
        }
        $button->add($title);
        $button->add($span);
        parent::add($button);
        
        //$this->id = 'tdropdown_' . uniqid();
        $this->elements = new TElement('ul');
        $this->elements->{'class'} = 'dropdown-menu pull-left';
        $this->elements->{'aria-labelledby'} = 'drop2';
        parent::add($this->elements);
    }
    
    /**
     * Define the pull side
     * @side left/right
     */
    public function setPullSide($side)
    {
        $this->elements->{'class'} = "dropdown-menu pull-{$side}";
    }

    /**
     * Define the button size
     * @size sm (small) lg (large)
     */
    public function setButtonSize($size)
    {
        $this->button->{'class'} = "btn btn-default btn-{$size} dropdown-toggle";
    }
    
    /**
     * Add an action
     * @param $title  Title
     * @param $action Action
     * @param $icon   Icon
     */
    public function addAction($title, TAction $action, $icon = NULL)
    {
        $li = new TElement('li');
        $link = new TElement('a');
        // if ($action instanceof TScriptAction) => don't __load_page... 
        $link->{'onclick'} = "__adianti_load_page('{$action->serialize()}');";
        $link->{'style'} = 'cursor: pointer';
        
        if ($icon)
        {
            $image = new TImage($icon);
            $image->{'style'} = 'padding: 4px';
            $link->add($image);
        }
        
        $span = new TElement('span');
        $span->add($title);
        $link->add($span);
        $li->add($link);
        
        $this->elements->add($li);
    }
    
    /**
     * Add a header
     * @param $header Options Header
     */
    public function addHeader($header)
    {
        $li = new TElement('li');
        $li->{'role'} = 'presentation';
        $li->{'class'} = 'dropdown-header';
        $li->add($header);
        $this->elements->add($li);
    }
    
    /**
     * Add a separator
     */
    public function addSeparator()
    {
        $li = new TElement('li');
        $li->{'class'} = 'divider';
        $this->elements->add($li);
    }
}
