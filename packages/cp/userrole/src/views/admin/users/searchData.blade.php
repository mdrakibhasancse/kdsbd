<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col" width="30">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Mobile</th>
            

        </tr>
    </thead>
    <tbody class="w3-small">
        <?php $i = (($users->currentPage() - 1) * $users->perPage() + 1); ?>
        @forelse ($users as $key => $user)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('admin.userEdit',$user)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                            <form action="{{ route('admin.userDelete',$user)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
           
                <td>
                    <img width="30px" height="20px"src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $user->fi()]) }}"
                    alt="">
                </td>

                <td>{{$user->name }}</td>

                <td>{{$user->email }}</td>
                
                <td>{{$user->mobile }}</td>
            
                
            </tr>

            
        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No User Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

