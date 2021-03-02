<?php


namespace App\State;

use App\Module;

class ModuleContext
{
    protected $state;
    public $module;

    public function __construct(Module $module) {
        $this->module = $module;
    }

    public function state() {
        return $this->state;
    }

    public function setState(ModuleState $state) {
        $this->state = $state;
    }
}