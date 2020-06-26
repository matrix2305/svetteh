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
                @if($message = session('error'))
                    <div class="false-message">
                        <p>{{$message}}</p>
                    </div>
                @endif
                @if($message = session('success'))
                        <div class="true-message">
                            <p>{{$message}}</p>
                        </div>
                 @endif
                <form action="{{route('storecategory')}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="item-label">
                        <label>Ime kategorije:</label>
                    </div>
                    <div class="item-input">
                        <input type="text" name="category_name">
                    </div>
                    <div class="item-label">
                        <label>Boja kategorije:</label>
                    </div>
                    <div class="item-input">
                        <input type="color" name="category_color"/>
                    </div>
                    <div class="item-input">
                        <button>Pošalji</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    @include('adminsidebar')
@endsection
