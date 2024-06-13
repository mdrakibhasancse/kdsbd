<div class="menu-depart @if(request()->q == null) show-always @endif">
    <a href="#" class="toggle" style="background-color:#FF5722;"><i class="fas fa-bars"></i>Shop by Category</a>
    <div class="submenu">
        <a href="{{url('/')}}" class=""><i class="icon-category-home"></i>Home</a>
        @foreach ($cats as $cat)
            <a href="{{route("category",$cat->slug)}}" class="d-flex" style="color:inherit">
                <img class="w3-round" src="{{ route('imagecache', ['template' => 'ppxxs', 'filename' => $cat->fi()]) }}" alt="">
                &nbsp;&nbsp;&nbsp;
                <span class="text-dark">{{$cat->name_en}}</span>
            </a>
        @endforeach
        <a href="{{ route('categoriesAll')}}">VIEW ALL <i class="icon-angle-right"></i></a>
    
    </div>
</div>