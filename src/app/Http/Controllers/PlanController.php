<?php


namespace App\Http\Controllers;

use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function show (Plan $plan) {
        return view('subscriptions.plans', compact('plan'));
    }

    public function agregarPlan (Request $request) {
        $plan = new Plan;
        $plan->name = $request->tituloPlan;
        $plan->prize = $request->precioPlan;
        $plan->status = $request->estadoPlan;
        $plan->price_stripe_id = $request->idStripePlan;
        $plan->save();

        if ($request->accesosATodosNuestrosCursos && $request->accesosATodosNuestrosCursos === "on") {
            $values = array('plan_id' => $plan->id, 'feature_id' => '1', 'benefit' => 'SI', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '1', 'benefit' => 'NO', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->oportunidadesPlan) {
            $values = array('plan_id' => $plan->id, 'feature_id' => '2', 'benefit' => $request->oportunidadesPlan, 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '2', 'benefit' => '0', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->pagoRecurrentePlan) {
            $values = array('plan_id' => $plan->id, 'feature_id' => '3', 'benefit' => $request->pagoRecurrentePlan, 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '3', 'benefit' => 'Mensual', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->atendemosTodasTusInquietudes && $request->atendemosTodasTusInquietudes === "on") {
            $values = array('plan_id' => $plan->id, 'feature_id' => '4', 'benefit' => 'SI', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '4', 'benefit' => 'NO', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->pagoDepositoPaypalYOtrosMetodos && $request->pagoDepositoPaypalYOtrosMetodos === "on") {
            $values = array('plan_id' => $plan->id, 'feature_id' => '5', 'benefit' => 'SI', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '5', 'benefit' => 'NO', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->certificadosDigitalesDeTusCursosAprobados && $request->certificadosDigitalesDeTusCursosAprobados === "on") {
            $values = array('plan_id' => $plan->id, 'feature_id' => '6', 'benefit' => 'SI', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '6', 'benefit' => 'NO', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->penetrationTestingStudent) {
            $values = array('plan_id' => $plan->id, 'feature_id' => '7', 'benefit' => $request->penetrationTestingStudent, 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->penetrationTestingProfessional) {
            $values = array('plan_id' => $plan->id, 'feature_id' => '8', 'benefit' => $request->penetrationTestingProfessional, 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->webApplicationTesting) {
            $values = array('plan_id' => $plan->id, 'feature_id' => '9', 'benefit' => $request->webApplicationTesting, 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->informationSecurityAnalyst) {
            $values = array('plan_id' => $plan->id, 'feature_id' => '10', 'benefit' => $request->informationSecurityAnalyst, 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        if ($request->derechoAReembolso && $request->derechoAReembolso === "on") {
            $values = array('plan_id' => $plan->id, 'feature_id' => '11', 'benefit' => 'SI', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        } else {
            $values = array('plan_id' => $plan->id, 'feature_id' => '11', 'benefit' => 'NO', 'created_at' => $plan->created_at);
            DB::table('plan_feature')->insert($values);
        }

        return redirect()->route('dashboard_planes');
    }

    public function editarPlan (Request $request) {
        $currentDateTime = Carbon::now();
        $plan = Plan::withTrashed()->find($request->idPlan);
        $plan->features()->detach();

        $plan->name = $request->tituloPlan;
        $plan->prize = $request->precioPlan;
        $plan->status = $request->estadoPlan;
        $plan->price_stripe_id = $request->idStripePlan;

        if ($plan->status === Plan::PUBLISHED) {
            $plan->deleted_at = null;
        }

        if ($plan->status === Plan::DELETED) {
            $plan->deleted_at = $currentDateTime->toDateTimeString();
        }

        $plan->save();

        if ($plan->status === "1") {

            if ($request->accesosATodosNuestrosCursos && $request->accesosATodosNuestrosCursos === "on") {
                $values = array('plan_id' => $plan->id, 'feature_id' => '1', 'benefit' => 'SI', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '1', 'benefit' => 'NO', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->oportunidadesPlan) {
                $values = array('plan_id' => $plan->id, 'feature_id' => '2', 'benefit' => $request->oportunidadesPlan, 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '2', 'benefit' => '0', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->pagoRecurrentePlan) {
                $values = array('plan_id' => $plan->id, 'feature_id' => '3', 'benefit' => $request->pagoRecurrentePlan, 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '3', 'benefit' => 'Mensual', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->atendemosTodasTusInquietudes && $request->atendemosTodasTusInquietudes === "on") {
                $values = array('plan_id' => $plan->id, 'feature_id' => '4', 'benefit' => 'SI', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '4', 'benefit' => 'NO', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->pagoDepositoPaypalYOtrosMetodos && $request->pagoDepositoPaypalYOtrosMetodos === "on") {
                $values = array('plan_id' => $plan->id, 'feature_id' => '5', 'benefit' => 'SI', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '5', 'benefit' => 'NO', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->certificadosDigitalesDeTusCursosAprobados && $request->certificadosDigitalesDeTusCursosAprobados === "on") {
                $values = array('plan_id' => $plan->id, 'feature_id' => '6', 'benefit' => 'SI', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '6', 'benefit' => 'NO', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->penetrationTestingStudent) {
                $values = array('plan_id' => $plan->id, 'feature_id' => '7', 'benefit' => $request->penetrationTestingStudent, 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->penetrationTestingProfessional) {
                $values = array('plan_id' => $plan->id, 'feature_id' => '8', 'benefit' => $request->penetrationTestingProfessional, 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->webApplicationTesting) {
                $values = array('plan_id' => $plan->id, 'feature_id' => '9', 'benefit' => $request->webApplicationTesting, 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->informationSecurityAnalyst) {
                $values = array('plan_id' => $plan->id, 'feature_id' => '10', 'benefit' => $request->informationSecurityAnalyst, 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

            if ($request->derechoAReembolso && $request->derechoAReembolso === "on") {
                $values = array('plan_id' => $plan->id, 'feature_id' => '11', 'benefit' => 'SI', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            } else {
                $values = array('plan_id' => $plan->id, 'feature_id' => '11', 'benefit' => 'NO', 'created_at' => $plan->created_at);
                DB::table('plan_feature')->insert($values);
            }

        }

        return redirect()->route('dashboard_planes');
    }

    public function eliminarPlan (Request $request) {
        $currentDateTime = Carbon::now();
        $plan = Plan::find($request->deleteId);
        $plan->status = Plan::DELETED;
        $plan->deleted_at = $currentDateTime->toDateTimeString();
        $plan->save();
        return redirect()->route('dashboard_planes');
    }
}