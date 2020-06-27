@extends('layouts.main')
@section('tittle', 'Učešća | Administracioni panel')

@section('content')
    <div class="main">
        <div class="tittle-page">
            Admin panel
        </div>
        <section>
            <div class="tittle-section">
                Izmena učešća: {{$role->name}}
            </div>

            <div class="content-section">
                @if($message = session('updated'))
                    <div class="true-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
               <form action="{{route('updateroles')}}" method="POST">
                   @csrf
                   @method('put')


               </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
