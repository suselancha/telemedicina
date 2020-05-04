@extends('frontend.layouts.app')

@section('contenido')
    @include('frontend.parciales.breadcumb', ['titulo' => 'Contacto', 'sub' => 'Su opinión es muy valiosa para nuestro equipo. Nos ayuda a mejorar las prestaciones día a día.'])
    @include('frontend.contacto.show')
    @include('frontend.parciales.banner1')
    @include('frontend.parciales.banner2')
@endsection