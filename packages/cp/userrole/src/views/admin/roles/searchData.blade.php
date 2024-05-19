<table class="table-striped table-bordered table-hover table-sm mb-1 table">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col">Name</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody class="w3-small">
        <?php $i = (($roles->currentPage() - 1) * $roles->perPage() + 1); ?>
            @forelse ($roles as $key => $role)
             <tr>
                <td scope="col">{{ $i++ }}</td>
                <td scope="col">{{ $role->name }}</td>
                <td scope="col">
                    <a class="btn btn-info btn-xs" href="{{ route('admin.roleShow', $role) }}">Show</a>

                    <a class="btn btn-primary btn-xs"
                        href="{{ route('admin.roleEdit', $role) }}">Edit</a>

                    @if(str_contains($role->name, 'admin'))

                    @else

    

                    <a href=""  onclick="event.preventDefault();
                                            document.getElementById('delete-form').submit();" 
                                            class="btn btn-danger btn-xs">Delete</a>

                        <form onsubmit="return confirm('Do you really want to delete this?');" id="delete-form" action="{{ route('admin.roleDelete', $role) }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    @endif
                    

                </td>
            </tr>

         
        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No Slider Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

