@extends('frontend.layouts.app')

@section('contenido')
    @include('frontend.parciales.breadcumb', ['titulo' => 'Especialidades', 'sub' => 'Personal integrado por profesionales, técnicos y auxiliares'])
    @include('frontend.especialidad.show')
    @include('frontend.parciales.banner1')
    @include('frontend.parciales.banner2')
@endsection