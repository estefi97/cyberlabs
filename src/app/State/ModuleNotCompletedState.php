<?php


namespace App\State;



class ModuleNotCompletedState implements ModuleState
{
    public function completado($module){}

    public function noCompletado($module)
    {
        if ($module->module->status === "1") {
            $ModuloCursoNoCompletado = new ModuleNotCompletedState;
            $module->setState($ModuloCursoNoCompletado);
        }
    }
}