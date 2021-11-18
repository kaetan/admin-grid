<?php

namespace Kaetan\AdminGrid;

class Action
{
    public $title;
    public $url;
    public $blank = false;
    public $buttonClass = false;
    public $formClass = false;

    public function __construct($title, $url, $blank = false)
    {
        $this->title = $title;
        $this->url = $url;
        $this->blank = $blank;
    }

    public function setUrlFunction($function)
    {
        $this->url = $function;
        return $this;
    }

    public function getTitle($row = null)
    {
        if (is_callable($this->title)) {
            return ($this->title)($row);
        }

        return ($this->title);
    }

    public function getUrl($row)
    {
        if (is_callable($this->url)) {
            return ($this->url)($row);
        }

        return ($this->url);
    }

    public function setClass($class)
    {
        $this->buttonClass = $class;
        return $this;
    }

    public function getClass()
    {
        return $this->buttonClass;
    }

    public function setFormClass($class)
    {
        $this->formClass = $class;
        return $this;
    }

    public function getFormClass()
    {
        return $this->formClass;
    }
}