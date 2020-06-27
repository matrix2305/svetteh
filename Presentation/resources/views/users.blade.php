@extends('layouts.main')
@section('tittle', 'Korisnici | Admin panel')

@section('content')
   <div class="main">
       <div class="tittle-page">
           Admin panel
       </div>
       <section>
           <div class="tittle-section">
               Korisnici
           </div>

           <div class="content-section">
               @if($message = session('deleted'))
                   <div class="true-message">
                       <p>{{$message}}</p>
                   </div>
               @endif
               <table>
                   <tr>
                       <th>Korisničko ime</th>
                       <th>E-pošta</th>
                       <th>Ime</th>
                       <th>Prezime</th>
                       <th>Učešće korisnika</th>
                       <th>Vreme poslednje izmene</th>
                       <th>Vreme kreiranja korisnika</th>
                       <th>Izmeni</th>
                       <th>Obriši</th>
                   </tr>
                   @foreach($users as $user)
                       <tr>
                           <td>{{$user->username}}</td>
                           <td>{{$user->email}}</td>
                           <td>{{$user->name}}</td>
                           <td>{{$user->lastname}}</td>
                           <td>{{$user->role->name}}</td>
                           <td>{{$user->updatedAt}}</td>
                           <td>{{$user->createdAt}}</td>
                           <td><a href=""><i style="color: black" class="fas fa-edit"></i></a></td>
                           <td><i onclick="document.getElementById('deleteUser{{$loop->index}}').submit();" class="fas fa-user-minus"></i></td>
                           <form id="deleteUser{{$loop->index}}" action="{{route('destroyuser')}}" method="POST" style="display: none">
                               @csrf
                               @method('delete')
                               <input type="hidden" name="id" value="{{$user->id}}">
                           </form>

                       </tr>
                   @endforeach
               </table>
           </div>
       </section>
       <section>
           <div class="tittle-section">
               dodaj korisnika
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
               <form  method="POST" action="{{ route('storeuser') }}">
                   @csrf
                   @method('put')
                   <label>Korisničko ime</label>
                   <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="name" autofocus>
                   @error('username')
                   <span class="invalid-feedback" role="alert">
                        <strong>Korisničko ime {{ $message }}</strong>
                    </span>
                   @enderror
                   <label>E-pošta</label>
                   <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                   @error('email')
                   <span class="invalid-feedback" role="alert">
                        <strong>E-pošta {{ $message }}</strong>
                    </span>
                   @enderror
                   <label>Učešće korisnika</label>
                   <select name="role">
                       @foreach($roles as $role)
                           <option value="{{$role->id}}">{{$role->name}}</option>
                       @endforeach
                   </select>

                   <label>Lozinka</label>
                   <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                   @error('password')
                   <span class="invalid-feedback">
                        <strong>Lozinka {{ $message }}</strong>
                   </span>
                   @enderror
                   <label>Potvrdi lozinku</label>
                   <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                   <button type="submit">
                       Registruj se
                   </button>
               </form>
        </div>
       </section>
   </div>
   @include('adminsidebar')
@endsection
