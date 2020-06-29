<sidebar class="sidebar">
    <div class="sidebar-tittle">
        Kategorije
    </div>
    <div class="categories">
        @foreach($categories as $category)
            <div class="category-item" style="background-color: {{$category->color}}">{{$category->name}}</div>
        @endforeach
    </div>
    <div class="sidebar-tittle">
        Reklame
    </div>

</sidebar>
