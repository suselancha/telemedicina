@extends('layouts.app')

@section('header')
    @include('parciales.header')
@endsection

@section('banner')
    @include('reserva.banner')
@endsection

@section('calendario')
    @include('reserva.calendario')
@endsection

@section('footer')
    @include('parciales.footer')
@endsection