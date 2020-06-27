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
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('roles')}}">Objave</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('createposts')}}">Dodaj objavu</a></li>
        <li><a id="{{(request()->path() == route('categories'))? 'active':''}}" href="{{route('categories')}}">Kategorije</a></li>
    </ul>
    <div class="sidebar-tittle">
        Korisnici
    </div>
    <ul>
        <li><a id="{{(request()->route() == route('users'))? 'active':''}}" href="{{route('users')}}">Uređuj korisnike</a></li>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('roles')}}">Uređuj učešća</a></li>
    </ul>

    <div class="sidebar-tittle">
        Sadržaj
    </div>
    <ul>
        <li><a id="{{(request()->path() == '')? 'active':''}}" href="">Uređuj sadržaj</a></li>
    </ul>
</aside>
