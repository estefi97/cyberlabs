<?php

namespace App\Http\Controllers;

use App\Subscription;
use App\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionController extends Controller
{
	public function __construct() {
		$this->middleware(function($request, $next) {
			if ( auth()->user()->subscribed('main') ) {
				return redirect('/')
					->with('message', ['warning', __("Actualmente ya estás suscrito a otro plan")]);
			}
			return $next($request);
		})
		->only(['plans', 'processSubscription']);
	}

	public function plans () {
		return view('subscriptions.plans');
    }

    public function processSubscription (Request $request) {

        $plan = Plan::where('price_stripe_id','=',$request->price_stripe_id)->first();
        $fechaComienzoSuscripcion = Carbon::now();
        $fechaFinSuscripcion = Carbon::now();
        $subscription = new Subscription;

        if (str_contains($plan->name, 'Anual')) {
            $fechaFinSuscripcion = $fechaComienzoSuscripcion->addYear();
            $subscription->quantity = '12';
        }

        if (str_contains($plan->name, 'Trimestral')) {
            $fechaFinSuscripcion = $fechaComienzoSuscripcion->addMonths(3);
            $subscription->quantity = '3';
        }

        if (str_contains($plan->name, 'Mensual')) {
            $fechaFinSuscripcion = $fechaComienzoSuscripcion->addMonths(1);
            $subscription->quantity = '1';
        }

	    $subscription->user_id = Auth::user()->id;
	    $subscription->name = $plan->name;
	    $subscription->stripe_id = $request->price_stripe_id;
	    $subscription->stripe_plan = $plan->name;
	    $subscription->created_at = Carbon::now()->toDateTimeString();
        $subscription->updated_at = $fechaComienzoSuscripcion->toDateTimeString();
        $subscription->ends_at = $fechaFinSuscripcion->toDateTimeString();
        $subscription->save();

        return redirect(route('subscriptions.admin'))
            ->with('message', ['success', __("La suscripción se ha llevado a cabo correctamente")]);

    }

    public function admin () {
		$subscriptions = auth()->user()->subscriptions;
		return view('subscriptions.admin', compact('subscriptions'));
    }

    public function resume () {
		$subscription = \request()->user()->subscription(\request('plan'));
		if ($subscription->cancelled() && $subscription->onGracePeriod()) {
			\request()->user()->subscription(\request('plan'))->resume();
			return back()->with('message', ['success', __("Has reanudado tu suscripción correctamente")]);
		}
		return back();
    }

    public function cancel () {
		auth()->user()->subscription(\request('plan'))->cancel();
	    return back()->with('message', ['success', __("La suscripción se ha cancelado correctamente")]);
    }

    public function agregarSuscripcion (Request $request) {
	    $fechaComienzoSuscripcion = \Carbon\Carbon::createFromFormat('Y-m-d', $request->fechaComienzoSuscripcion);
	    $fechaFinSuscripcion = \Carbon\Carbon::createFromFormat('Y-m-d', $request->fechaFinSuscripcion);

	    $subscription = new Subscription;
	    $subscription->user_id = $request->usuarioSeleccionado;
	    $subscription->name = "Generada Manualmente";
	    $subscription->stripe_id = "-";
	    $subscription->stripe_plan = "-";
	    $subscription->quantity = $fechaComienzoSuscripcion->diffInMonths($fechaFinSuscripcion);
	    $subscription->created_at = $request->fechaComienzoSuscripcion;
	    $subscription->updated_at = $request->fechaComienzoSuscripcion;
	    $subscription->ends_at = $request->fechaFinSuscripcion;
	    $subscription->save();
	    return redirect()->route('dashboard_suscripciones');
    }

    public function editarSuscripcion (Request $request) {
        $fechaComienzoSuscripcion = \Carbon\Carbon::createFromFormat('Y-m-d', $request->fechaComienzoSuscripcion);
        $fechaFinSuscripcion = \Carbon\Carbon::createFromFormat('Y-m-d', $request->fechaFinSuscripcion);

        DB::update('update subscriptions set quantity = ?, created_at = ?, ends_at = ? where id = ?', [$fechaComienzoSuscripcion->diffInMonths($fechaFinSuscripcion), $request->fechaComienzoSuscripcion, $request->fechaFinSuscripcion, $request->idSuscripcion]);

        return redirect()->route('dashboard_suscripciones');
    }

    public function eliminarSuscripcion (Request $request) {
	    $subscription = Subscription::find($request->deleteId);
	    $currentDate = Carbon::now();
	    $subscription->ends_at = $currentDate->toDateTimeString();
	    $subscription->save();
	    return redirect()->route('dashboard_suscripciones');
    }
}
