<aside class="sidebar">
    <div class="sidebar-tittle">
        Monitoring
    </div>
    <ul>
        <li><a id="{{(request()->path() == 'dashboard')? 'active-ul':''}}" href="{{route('dashboard')}}">Statistika</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Istorija</a></li>
    </ul>
    <div class="sidebar-tittle">
        Objave
    </div>
    <ul>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Dodaj objavu</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Izmeni objave</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Dodaj kategoriju</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Izmeni kategorije</a></li>
    </ul>
    <div class="sidebar-tittle">
        Korisnici
    </div>
    <ul>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Dodaj korisnika</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Izmeni korisnike</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Dodaj učešće</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Izmeni učešća</a></li>
    </ul>

    <div class="sidebar-tittle">
        Sadržaj
    </div>
    <ul>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Uređuj sadržaj</a></li>
        <li><a id="{{(request()->path() == '')? 'active-ul':''}}" href="">Uređuj kontakt informacije</a></li>
    </ul>
</aside>
