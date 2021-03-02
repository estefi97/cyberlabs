<?php


namespace App\State;

interface ModuleState
{
    public function completado($module);
    public function noCompletado($module);
}