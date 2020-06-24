@extends('layouts.main')

@section('tittle', 'Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                dodaj kategoriju
            </div>
            <div class="content-section">
                Sardrzaj
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
