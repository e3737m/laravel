@extends('temp')

@section('content')
@component('components.card', [
                              'card_title' => 'titolo immagine'
                             ])
provissima ipsum lorem
@endcomponent

@stop


@section('prova')
@parent
questa è una prova
@stop

