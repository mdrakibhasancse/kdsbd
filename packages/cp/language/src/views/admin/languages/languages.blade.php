@extends('admin::layouts.adminMaster')
@section('title')
    | Languages
@endsection

@push('css')
@endpush


@section('content') 
<section class="content py-3">
    <div class="row w3-animate-zoom">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                            class="fas fa-language text-primary"></i> Languages</h3>
                    <div class="card-tools w3-small">

                        <a href="" class="btn-create-from btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fas fa-plus-square"></i> Create New</a>
                    </div>
                </div>
            </div>
            <div class="card w3-round mb-2 shadow-lg card-create-form-toggle">
                <div class="card-body w3-light-gray">
                <form action="{{ route('admin.languageStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-md-6 m-auto card p-5">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is_invalid @enderror" id="title" placeholder="Title.." name="title" value="{{ old('title') }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Language Code</label>
                                <input type="text" class="form-control @error('code') is_invalid @enderror" id="code" placeholder="Language code" name="code" value="{{ old('code') }}">
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                           <div class="form-group">
                            <input type="submit" class="btn btn-primary float-right" value="Save">
                           </div>
                        </div>
                    </div>
                </form>

            </div>
            </div>
            <div class="card w3-round shadow-lg">
                <div class="ccard-header pl-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted"><i class="fas fa-language text-primary pt-1"></i> All Languages </h3>
                    <div class="card-tools">
                       
                    </div>
                </div>
               

                <div class="card-body bg-light px-2 py-2">
                  <div class="table-responsive">
                    <table class="table-striped table-bordered table-hover table-sm mb-1 table">
                    <thead class="w3-small text-muted thead-light">
                        <tr>
                          <th style="width: 10px">#SL</th>
                          <th>Action</th>
                          <th>Tilte</th>
                          <th>Language Code</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = (($languages->currentPage() - 1) * $languages->perPage() + 1); ?>
                        @foreach($languages as $lng)
                        <tr>
                          <td style="width: 10px">{{$i++}}</td>
                          <td style="width: 80px">
                              <div class="dropdown show">
                                <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a href="{{ route('admin.languageTranslatoins',$lng)}}" title="Tranlation" class="dropdown-item"><i class="fa fa-language"></i> Tranlation</a>

                                    <a title="Edit" href="{{ route('admin.languageEdit',$lng) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                                    <form action="{{ route('admin.languageDelete',$lng) }}" method="post" onclick="return confirm('Are you sure to delete?')">
                                      @csrf
                                      <button type="submit" title="Delete"  class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                          </td>
                          <td>{{$lng->title}}</td>
                          <td>{{$lng->language_code}}</td>


                          <td>
                              <input type="checkbox" name="toogle" data-url="{{route('admin.languageStatus')}}" value="{{ $lng->id }}" data-toggle="toggle" data-size="sm" {{$lng->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
              </div>

            </div>
        </div>
    </div>
</section>
@endsection



@push('js')
    <script>
        $( document ).ready(function() {
            $('input[name=toogle]').change(function(){
                var that = $( this );
                var url  = that.attr('data-url');
                var id   = that.val()
                var mode = that.prop('checked');
                $.ajax({
                    url : url,
                    type: "POST",
                    data:{
                        _token:'{{csrf_token()}}',
                        mode:mode,
                        id:id,
                    },
                    success:function(response){
                        if(response.status){
                            alert(response.msg);
                        }
                        else{
                            alert('please try again');
                        }
                    }
                })
            });
        });


    </script>
@endpush
