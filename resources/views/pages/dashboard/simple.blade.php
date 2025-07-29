@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Dashboard Sederhana</h1>
    <p>Selamat datang, {{ auth()->user()->name }}!</p>
    <p>Role: {{ auth()->user()->role }}</p>
</div>
@endsection 