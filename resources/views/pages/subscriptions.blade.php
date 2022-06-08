@extends('layouts.main-layout')

@section('title', 'Подписки')

@section('content')

@include('layouts.subscriptions-layout', ['subscriptions' => $subscriptions])

@endsection
