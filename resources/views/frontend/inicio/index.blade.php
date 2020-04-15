@extends('frontend.layouts.app')

@section('header')
    @include('frontend.parciales.header')
@endsection

@section('banner')
    @include('frontend.inicio.banner')
@endsection

@section('contacto')
    @include('frontend.parciales.contacto')
@endsection

@section('footer')
    @include('frontend.parciales.footer')
@endsection

@section('modal')
    @include('frontend.parciales.modal')
@endsection