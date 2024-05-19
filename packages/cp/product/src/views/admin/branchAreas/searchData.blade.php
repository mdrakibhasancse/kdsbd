<table class="table table-striped table-bordered table-hover table-md">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col">Area English</th>
            <th scope="col">Area (বাংলা)</th>
            {{-- <th scope="col">Branch English</th>
            <th scope="col">Branch (বাংলা)</th> --}}
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody class="w3-small">
        <?php $i = (($areas->currentPage() - 1) * $areas->perPage() + 1); ?>
        @forelse ($areas as $key => $area)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a href="{{ route('admin.branchAreaEdit', ['brancharea' => $area , 'branch' => $area->branch])}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                            <form action="{{ route('admin.branchAreaDelete',$area)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
              

                <td>{{ Str::limit($area->name_en, 30) }}</td>
                <td>{{ Str::limit($area->name_bn, 30)}}</td>

                {{-- <td>{{ $area->branch->name_en ?? ''}}</td>
                <td>{{ $area->branch->name_bn ?? ''}}</td> --}}


                <td scope="col">
                    @if($area->active == 1)
                    <button class="badge border-0 badge-primary branchAreaStatus" data-url="{{route("admin.branchAreaStatus",['brancharea'=> $area->id])}}" >
                        Active
                    </button>
                    @else
                    <button class="badge border-0 badge-danger branchAreaStatus" data-url="{{route("admin.branchAreaStatus",['brancharea'=> $area->id])}}" >
                        Inactive
                    </button>
                    @endif
                </td>
                
            
                
            </tr>

         
        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No branch area Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

