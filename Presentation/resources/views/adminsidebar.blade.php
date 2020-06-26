<aside class="sidebar">
    <div class="sidebar-tittle">
        Monitoring
    </div>
    <ul>
        <li><a id="{{(request()->path() == 'dashboard')? 'active':''}}" href="{{route('dashboard')}}">Statistika</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Istorija</a></li>
    </ul>
    <div class="sidebar-tittle">
        Objave
    </div>
    <ul>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Dodaj objavu</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Izmeni objave</a></li>
        <li><a id="{{(request()->path() == route('addcategory'))? 'active':''}}" href="{{route('addcategory')}}">Dodaj kategoriju</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Izmeni kategorije</a></li>
    </ul>
    <div class="sidebar-tittle">
        Korisnici
    </div>
    <ul>
        <li><a id="{{(request()->route() == route('createuser'))? 'active':''}}" href="{{route('createuser')}}">Dodaj korisnika</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Izmeni korisnike</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Dodaj učešće</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Izmeni učešća</a></li>
    </ul>

    <div class="sidebar-tittle">
        Sadržaj
    </div>
    <ul>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Uređuj sadržaj</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Uređuj kontakt informacije</a></li>
    </ul>
</aside>
