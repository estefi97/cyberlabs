@extends('layouts.app')
<title>Planes | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('content')
<link rel="stylesheet" href="{{ asset('css/pricing.css') }}">
<script src="https://js.stripe.com/v3/"></script>

<script>
    function redirectToPay (clicked_id) {

        let stripe = Stripe('pk_test_51IQXiUG59drQnUmwfnp0E6gP0QxKmmODFB12Vf5zPhwbkwktewSb1O921lRWKbDDm7ESjptFj4kSncaz0ibngOUC00Mi9bXEAw');
        let price_stripe_id = clicked_id;

        stripe.redirectToCheckout({
            lineItems: [{price: price_stripe_id, quantity: 1}],
            mode: 'subscription',
            successUrl: `https://cyberlabs.test/subscriptions/process_subscription/${price_stripe_id}`,
            cancelUrl: 'https://cyberlabs.test/planes',
        })
            .then(function (result) {
                console.log(result);
                if (result.error) {
                    var displayError = document.getElementById('error-message');
                    displayError.textContent = result.error.message;
                }
            });
    }
</script>
<div class="row justify-content-center" style="margin-top: 50px;">
    <h1 class="h1-planes" style="color: black !important;">{{ __("PlanesUneteTitulo") }}</h1>
</div>
<div class="row justify-content-center">

    @forelse($plan->all() as $plan)
        <div class="f-top text-center f-normal-text-color" style="margin-top: 50px; float: left; margin-right: 15px;">
            <div class="inline-block text-left">
                <div class="f-card white f-radius-medium f-shadow-medium relative full-width relative">
                    <div class="f-padding-x-large f-padding-y pricing-AR">
                        <div class="between-xs bottom-xs pricing-row row text-left">
                            <p class="bold no-margin normal-line-height">
                                <span class="h2">${{ $plan->prize }}</span>
                                <span class="f-secondary-text f-text-16">USD/mes</span>
                            </p>
                        </div>
                        <div class="f-border-bottom f-padding-bottom-small f-top-intersection text-left">
                            @if (app()->getLocale() === "en")
                                @if ($plan->name === "Plan Anual")
                                    <h1 class="bold h2 no-margin normal-line-height">Annual Plan</h1>
                                @endif
                                @if ($plan->name === "Plan Trimestral")
                                    <h1 class="bold h2 no-margin normal-line-height">Quarterly Plan</h1>
                                @endif
                                @if ($plan->name === "Plan Mensual")
                                    <h1 class="bold h2 no-margin normal-line-height">Monthly plan</h1>
                                @endif
                            @else
                                <h1 class="bold h2 no-margin normal-line-height">{{ $plan->name }}</h1>
                            @endif
                        </div>
                        @if ($plan->features->count() > 0)
                            <div class="f-top-intersection">
                                <ul class="no-margin no-padding">
                                    @for ($i = 1; $i < $plan->features->count(); $i++)
                                        @if(DB::table('plan_feature')->where([['feature_id','=',$i],['plan_id','=',$plan->id]])->first()->benefit === "SI")
                                            <li class="row middle-xs">
                                                <div class="normal-svg stroke-svg color-svg bold h4 right-space">
                                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M20 6L9 17L4 12" stroke="#5D63F6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </div>
                                                <p class="col-xs no-padding no-margin">{{ DB::table('features')->where('id','=',$i)->first()->description }}</p>
                                            </li>
                                        @endif
                                        @if(DB::table('plan_feature')->where([['feature_id','=',$i],['plan_id','=',$plan->id]])->first()->benefit === "NO" && $i < 7)
                                            <li>
                                                <p class="col-xs no-padding no-margin"><span style="margin-left: .3em; margin-right: .3em; font-size: 17px; color: #0047ff;">✗</span> {{ DB::table('features')->where('id','=',$i)->first()->description }}</p>
                                            </li>
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                        @endif
                        @if (!Auth::guest())
                            @if (DB::table('subscriptions')->where([['user_id','=',Auth::user()->id],['ends_at','>',\Carbon\Carbon::Now()]])->count() === 0)
                                <div class="bottom-xs center-xs f-top pricing-row row text-left">
                                    <a onclick="redirectToPay(this.id)" id="{{ $plan->price_stripe_id }}" class="text-center f-main-btn block rb-normal top-space no-margin-xs f-text-16 full-width" style="font-weight: 700">{{ __("BtnPlanesSuscribirme") }}</a>
                                </div>
                            @endif
                        @else
                            <div class="bottom-xs center-xs f-top pricing-row row text-left">
                                <a class="text-center f-main-btn block rb-normal top-space no-margin-xs f-text-16 full-width" href="{{ route('login') }}" style="font-weight: 700">{{ __("BtnPlanesSuscribirme") }}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty

    @endforelse
</div>
@endsection