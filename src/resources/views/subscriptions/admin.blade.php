@extends('layouts.app')
<title>{{ __("TituloMisSuscripciones") }} | Cyberlabs</title>
<style>
    body {
        background-color: white !important;
    }
</style>
@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Manejar mis suscripciones', 'icon' => 'list-ol'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-around">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center;">{{ __("TablaMisSuscripciones1") }}</th>
                        <th scope="col" style="text-align: center;">Plan</th>
                        <th scope="col" style="text-align: center;">{{ __("TablaMisSuscripciones2") }}</th>
                        <th scope="col" style="text-align: center;">{{ __("TablaMisSuscripciones3") }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                        <tr>
                            <td style="text-align: center;">{{ $subscription->name }}</td>
                            <td style="text-align: center;">{{ $subscription->stripe_plan }}</td>
                            <td style="text-align: center;">{{ $subscription->created_at->format('d/m/Y') }}</td>
                            <td style="text-align: center;">{{ $subscription->ends_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">{{ __("No hay ninguna suscripción disponible") }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection