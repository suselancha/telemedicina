@extends('frontend.layouts.app')

@section('contenido')
    @include('frontend.inicio.banner')
    @include('frontend.inicio.seccion')
    {{--@include('frontend.inicio.about')
    @include('frontend.inicio.team')
    @include('frontend.inicio.especialidad')--}}    
    @include('frontend.parciales.banner2')
    @include('frontend.parciales.banner1')
@endsection