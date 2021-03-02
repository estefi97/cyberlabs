<?php

namespace App;

use App\State\ModuleContext;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Module extends Model
{

    protected $context;

    protected $module;

    ///////////////////////////////////////
    ///      BEGIN: PATRON STATE       ///
    /////////////////////////////////////

    public function status (Module $module) {
        $this->module = $module;
        $this->context = new ModuleContext($this->module);
        $this->context->setState(new \App\State\ModuleNotCompletedState);

        if (DB::table('module_user')->where([['module_id','=',$this->module->id],['user_id','=',auth()->user()->id],['status','=','2']])->count() > 0) {
            $statusModule = DB::table('module_user')->where([['module_id','=',$this->module->id],['user_id','=',auth()->user()->id],['status','=','2']])->first()->status;
        } else {
            $statusModule = "1";
        }


        if ($statusModule === "2") {

            $this->context->setState(new \App\State\ModuleCompletedState);
            $this->context->state()->completado($this->context, $this->module);

        } else if ($statusModule === "1") {

            $this->context->setState(new \App\State\ModuleNotCompletedState);
            $this->context->state()->noCompletado($this->context, $this->module);

        }

        return $this->context->state();
    }

    /////////////////////////////////////
    ///      END: PATRON STATE       ///
    ///////////////////////////////////

    use SoftDeletes;

    const PUBLISHED = 1;
    const DELETED = 2;
    const MODULENOTSTARTED = 0;
    const MODULEPENDING = 1;
    const MODULECOMPLETED = 2;

    public function courses () {
        return $this->belongsToMany(Course::class, 'module_course')
            ->withPivot('course_id');
    }

    public function getRouteKeyName() {
        return 'slug';
    }
}
