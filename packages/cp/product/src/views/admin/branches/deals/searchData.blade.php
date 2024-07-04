<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col">Title</th>
            <th scope="col">Excerpt</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody class="">
        <?php $i = (($deals->currentPage() - 1) * $deals->perPage() + 1); ?>
        @forelse ($deals as $key => $deal)

            
            <tr>
                <td scope="col">{{ $i++ }}</td>
                <td scope="col">
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{  route('admin.dealEdit',$deal)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                            <a href="{{ route('admin.dealDetails',['deal' => $deal, 'branch' => $branch])}} " class="dropdown-item"><i class="fa fa-eye"></i> Details</a>

                            <form action="{{ route('admin.dealDelete',$deal)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
               

                <td>{{ Str::limit($deal->title, 30) }}</td>
                <td>{{ Str::limit($deal->excerpt, 30) }}</td>
                <td scope="col">
                    @if($deal->active == 1)
                    <button class="badge border-0 badge-primary dealStatus" data-url="{{route("admin.dealStatus",['deal'=> $deal->id])}}" >
                        Active
                    </button>
                    @else
                    <button class="badge border-0 badge-danger dealStatus" data-url="{{route("admin.dealStatus",['deal'=> $deal->id])}}" >
                        Inactive
                    </button>
                    @endif
                </td>
                
            
                
            </tr>

         
        @empty
            <tr>
                <td colspan="7" class="text-danger h5 text-center">No Deal Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

