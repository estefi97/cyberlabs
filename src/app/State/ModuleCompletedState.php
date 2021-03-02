<?php


namespace App\State;


class ModuleCompletedState implements ModuleState
{
    public function completado($module)
    {
        if ($module->module->status === "2") {
            $ModuloCursoCompletado = new ModuleCompletedState;
            $module->setState($ModuloCursoCompletado);
        }
    }

    public function noCompletado($module) {}
}