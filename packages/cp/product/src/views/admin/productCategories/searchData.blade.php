<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col">Name English</th>
            <th scope="col">Name (বাংলা)</th>
            <th scope="col">Image</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody class="">
        <?php $i = (($categories->currentPage() - 1) * $categories->perPage() + 1); ?>
        @forelse ($categories as $key => $category)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('admin.productCategoryEdit',$category)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                            <form action="{{ route('admin.productCategoryDelete',$category)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
              

                <td>{{ Str::limit($category->name_en, 30) }}</td>
                <td>{{ Str::limit($category->name_bn, 30) }}</td>
                 <td>
                    <img width="30px" height="20px"src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $category->fi()]) }}"
                    alt="">
                </td>

                  <td scope="col">
                    @if($category->active == 1)
                    <button class="badge border-0 badge-primary categoryStatus" data-url="{{route("admin.categoryStatus",['category'=>$category->id])}}" >
                        Active
                    </button>
                    @else
                    <button class="badge border-0 badge-danger categoryStatus" data-url="{{route("admin.categoryStatus",['category'=>$category->id])}}" >
                        Inactive
                    </button>
                    @endif
                </td>
                
            
                
            </tr>

         
        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No Category Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

