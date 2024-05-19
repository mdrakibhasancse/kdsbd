<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="w3-small">
        <?php $i = (($permissions->currentPage() - 1) * $permissions->perPage() + 1); ?>
            @forelse ($permissions as $key => $permission)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                        

                    <a class="btn btn-primary btn-xs"
                        href="{{ route('admin.permissionEdit', $permission) }}">Edit</a>

                            <a href=""  onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();" 
                                            class="btn btn-danger btn-xs">Delete</a>

                        <form onsubmit="return confirm('Do you really want to delete this?');" id="delete-form" action="{{ route('admin.permissionDelete', $permission) }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    

                </td>
            </tr>

         
        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No Slider Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

