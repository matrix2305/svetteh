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
        @if(Permission::Check('posts.edit') or Permission::Check('posts.delete'))
            <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('posts')}}">Objave</a></li>
        @endif

        @if(Permission::Check('posts.create'))
                <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('createposts')}}">Dodaj objavu</a></li>
        @endif
        @if(Permission::Check('category.create') or Permission::Check('category.edit') or Permission::Check('category.delete'))
                <li><a id="{{(request()->path() == route('categories'))? 'active':''}}" href="{{route('categories')}}">Kategorije</a></li>
        @endif
        @if(Permission::Check('comments.delete') or Permission::Check('category.allow'))
                <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('comments')}}">Komentari</a></li>
            @endif
    </ul>
    <div class="sidebar-tittle">
        Korisnici
    </div>
    <ul>
        @if(Permission::Check('category.delete') or Permission::Check('category.edit') or Permission::Check('category.create'))
            <li><a id="{{(request()->route() == route('users'))? 'active':''}}" href="{{route('users')}}">Uređuj korisnike</a></li>
        @endif
        @if(Permission::Check('roles.delete') or Permission::Check('roles.create') or Permission::Check('roles.edit'))
            <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('roles')}}">Uređuj učešća</a></li>
        @endif
    </ul>

    <div class="sidebar-tittle">
        Sadržaj
    </div>
    <ul>
        @if(Permission::Check('content.edit'))
            <li><a id="{{(request()->path() == '')? 'active':''}}" href="{{route('content')}}">Uređuj sadržaj</a></li>
        @endif
    </ul>
</aside>
