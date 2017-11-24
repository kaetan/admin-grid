<?php

namespace Estaticzz\AdminGrid;

class Action
{
    public $title;
    public $url;
    public $blank = false;
    public $buttonClass = false;

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
}