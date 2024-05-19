<table class="table-striped table-bordered table-hover table-sm mb-1 table">
    <thead class="w3-small text-muted thead-light">
        <tr>
            <th scope="col" width="30">SL</th>
            <th scope="col" width="60">Action</th>
            <th scope="col" width="30">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Link</th>
            <th scope="col">Status</th>
            

        </tr>
    </thead>
    <tbody class="w3-small">
        <?php $i = (($sliders->currentPage() - 1) * $sliders->perPage() + 1); ?>
        @forelse ($sliders as $key => $slider)
            <tr>
                <td scope="row">{{ $i++ }}</td>
                <td scope="row">
                   
                    <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a title="Edit" href="" data-toggle="modal" data-target="#fsedit{{ $slider->id }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                            <form action="{{ route('admin.sliderDelete',$slider)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
              

                <td>
                    <img width="30px" height="20px"src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $slider->fi()]) }}"
                    alt="">
                </td>

                <td>{{ Str::limit($slider->title, 30) }}</td>

                <td>{{ Str::limit($slider->description, 30) }}</td>
                
                <td>{{ Str::limit($slider->link, 30) }}</td>
                <td scope="col">
                    @if($slider->active == 1)
                    <button class="badge border-0 badge-primary sliderStatus" data-url="{{route("admin.sliderStatus",['slider'=>$slider->id])}}" >
                        Active
                    </button>
                    @else
                    <button class="badge border-0 badge-danger sliderStatus" data-url="{{route("admin.sliderStatus",['slider'=>$slider->id])}}" >
                        Inactive
                    </button>
                    @endif
                </td>
            
                
            </tr>

            <div class="modal fade" id="fsedit{{ $slider->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="card mb-2 shadow-lg">
                            <div class="card-header px-2 py-1">
                                <h3 class="card-title w3-small text-bold text-muted pt-1">
                                    <i class="fas fa-sitemap text-primary"></i> Edit Slider</h3>
                                <div class="card-tools w3-small mr-2">
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card w3-round mb-2 shadow-lg">
                            <div class="card-body px-3 py-1 card-form-bg-color">
                                <form class="" action="{{route('admin.sliderUpdate',$slider->id)}}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group input-group-sm w3-small col-md-12 mb-0">
                                            <label for="title">Title </label>
                                            <input type="text" name="title"
                                            id="title" placeholder="Title here"
                                            class="form-control"
                                            value="{{ $slider->title }}" required>
                                            @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    
                                        <div class="form-group input-group-sm w3-small col-md-12 mb-0 mt-2 row">
                                            <label for="featured_image">Featured Image <span>(width:960px and height 20px)</span></label>
                                            <div class="col-6">
                                                <input type="file" name="featured_image" id="featured_image">
                                            </div>
                                            <div class="col-6">
                                                <img  src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $slider->fi()]) }}"
                                                    alt="">
                                            </div>
                                            @error('featured_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group input-group-sm w3-small col-md-12 mb-0">
                                            <label for="link">Link</label>
                                            <input type="text" name="link" id="link"
                                                class="form-control" value="{{ $slider->link }}" placeholder="Link here..."> <br>
                                        </div>
                                        
                                        <div class="form-group input-group-sm w3-small col-md-12">
                                            <label for="tag">Description 
                                            </label><textarea rows="1" name="description" id="description"
                                            class="form-control" placeholder="Description Here">{{ $slider->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-row mt-n3 mb-n2">
                                        <div class="col-md-8"></div>

                                        <div class="form-group input-group-sm col-md-2 w3-small active_checkbox pt-3">
                                            <input class="form-check-input" name="active" type="checkbox" {{ $slider->active ? 'checked' : '' }} id="active{{ $slider->id }}">
                                            <label for="active{{ $slider->id }}"  role="button">Active</label>
                                        </div>

                                        <div class="form-group input-group-xs col-md-2 w3-small pt-2">
                                            <label for=""> &nbsp; </label>
                                            <button type="submit"
                                                class="btn btn-primary btn-xs btn-block mt-n3">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>
        @empty
            <tr>
                <td colspan="6" class="text-danger h5 text-center">No Slider Found</td>
            </tr>
        @endforelse
    </tbody>
</table>

