@extends('admin::layouts.adminMaster')
@section('title')
    | Product Create
@endsection

@push('css')
@endpush

@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header px-2 py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-plus-circle text-primary"></i>&nbsp; Add New Product</h3>
                    <div class="card-tools w3-small">
                        <a href="{{ route('admin.productsAll')}}" class="btn-create-from btn btn-outline-primary btn-xs pull-right mr-2 py-1"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                </div>
            </div>


           
             
            <form action="{{ route('admin.productStore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                
                    <div class="row" >
                        <div class="col-sm-7">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name_en">Name English</label>
                                        <input type="text" name="name_en" value="{{old('name_en')}}" class="form-control" placeholder="Name English" required>
                                        @error('name_en')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="name_bn">Name (বাংলা)</label>
                                        <input type="text" name="name_bn" value="{{old('name_bn')}}" class="form-control" placeholder="Name (বাংলা)">
                                    </div>


                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" value="{{old('price')}}" class="form-control" placeholder="Enter price">
                                        @error('price')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="discount">Discount(flat)</label>
                                        <input type="number" name="discount" value="{{old('discount')}}" class="form-control" placeholder="Enter discount">
                                    </div>


                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <input type="text" name="unit" value="{{old('unit')}}" class="form-control" placeholder="Unit (e.g. KG, Pc etc)">
                                        @error('unit')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    

                                    <div class="form-group">
                                        <label>Tags (For Search)</label>
                                        <select class="productTags"
                                            id="tags"
                                            name="tags[]"
                                            multiple="multiple"
                                            data-ajax-url="{{route('admin.productTags')}}"
                                            data-ajax-dataType="json"
                                            data-placeholder="Select Tags From list or Add New" style="width: 100%;"
                                            data-select2-id="23"
                                            data-ajax-delay="200"
                                            >
                                            @if(old('tags'))
                                            @foreach(old('tags') as $tagg)
                                            <option selected="selected">{{ $tagg }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                            
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="excerpt_en">Excerpt English</label>
                                        <textarea name="excerpt_en" id="excerpt_en" class="form-control" rows="2" placeholder="Excerpt English">{{old('excerpt_en')}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="excerpt_bn">Excerpt (বাংলা)</label>
                                        <textarea name="excerpt_bn" id="excerpt_bn" class="form-control" rows="2" placeholder="Excerpt (বাংলা)">{{old('excerpt_bn')}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description_en">Description English</label>
                                        <textarea name="description_en" id="summernote" class="form-control summernote" rows="5" placeholder=" Description English">{{old('description_en')}}</textarea>
                                    </div>


                                    <div class="form-group">
                                        <label for="description_bn">Description (বাংলা)</label>
                                        <textarea name="description_bn" id="summernote" class="form-control summernote" rows="4" placeholder=" Description (বাংলা)">{{old('description_bn')}}</textarea>
                                    </div>


                                    <div class="form-group">
                                        <label class="mr-3"><input type="checkbox"  name="active" checked {{  old('active') == 1 ? 'checked' : '' }}> Active</label>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                        <label>
                                            <input type="checkbox"  name="editor" checked {{  old('editor') == 1 ? 'checked' : '' }}> Editor
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>





                        </div>
                        <div class="col-sm-5">
                            <div class="card card-primary card-outline" style="margin-bottom: 20px;">
                                <div class="card-header">
                                    <h3 class="card-title">Add Featured Image</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="feature_image" class="col-sm-4 col-form-label">Featured Image</label>
                                        <div class="col-sm-6">
                                            <input type="file" class="form-control-file" id="feature_image" name="featured_image" value="{{old('feature_image')}}">
                                        </div>
                                        @error('feature_image')
                                        <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @includeIf('media::admin.medias.mediaContainer')

                        </div>
                    </div>



                @if($categories->count() > 0)
                <div class="row">
                    <div class="col-12">
                        <div class="add-categories-subcategories">
                            <div class="card card-primary card-outline">
                                <div class="card-header with-border">
                                    <h3 class="card-title">Add Category, Subcategory</h3>
                                </div>
                                <div class="card-body p-2">
                                    @foreach($categories as $cat)
                                
                                    <div class="category-area">
                                        <div class="custom-control custom-checkbox bg-light rounded-lg mb-1">
                                        <input type="checkbox"  class="custom-control-input  toggle-category-checkbox" id="customCheckId_{{ $cat->id }}"  name="categories[]" value="{{$cat->id}}">
                                        <label class="custom-control-label" for="customCheckId_{{ $cat->id }}">{{ $cat->name_en ?? $cat->name_bn }}</label>
                                        </div>
                                        @if($cat->subcategories()->first())
                                            <div class="pl-3  subcat-add"  style="display:none;">
                                                <small class="text-muted">Subcategories</small>
                                                @foreach($cat->subcategories as $sub)
                                                <div class="subcat-area">
                                                    <div class="custom-control custom-radio  bg-light rounded-lg mb-1">
                                                        <input type="radio" id="customSubCheckId_{{ $sub->id }}" name="subcategories_{{ $cat->id }}[]" class="custom-control-input toggle-subcategory-radio"  value="{{$sub->id}}">
                                                    
                                                        <label class="custom-control-label" for="customSubCheckId_{{ $sub->id }}">{{$sub->name_en ?? $sub->name_bn}}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                @endif


                

                <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary px-5" value="Save Product">
                </div>

            </form>
             
                    
            


           
        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('click', ".productStatus", function(e){
                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                $.ajax({
                    url: url,
                    method: "get",
                    success: function(res)
                    {
                    if(res.active == true)
                    {
                        that.removeClass('badge-danger').addClass('badge-primary');
                        that.text('Active');
                    }
                    else
                    {
                        that.removeClass('badge-primary').addClass('badge-danger');
                        that.text('Inactive');
                    }
                    }
                });
            });

            $(document).on('keyup', ".product-search", function(e){
                e.preventDefault();
                var that = $( this );
                var url = that.attr('data-url');
                var q = that.val();
                $.ajax({
                    url: url,
                    data : {q:q},
                    method: "get",
                    success: function(res)
                    {
                        if(res.success)
                        {
                            $(".data-container").empty().append(res.page);
                        }
                    }
                });
            });

            $('.productTags').select2({
                minimumInputLength: 1,
                tags:true,
                tokenSeparators: [','],
                ajax: {
                data: function (params) {
                    return {
                    q: params.term, // search term
                    page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    var data = $.map(data, function (obj) {
                    obj.id = obj.id || obj.name;
                    return obj;
                    });
                    var data = $.map(data, function (obj) {
                    obj.text = obj.text || obj.name;
                    return obj;
                    });
                    return {
                    results: data,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                }
                },
            });
        });
        function makeSlug(val) {
            let str = val;
            let output = str.replace(/\s+/g, '-').toLowerCase();
            $('#slug').val(output);
        }
    </script>

    <script>
        $(document).ready(function() {
        
        var generalSubcats = '';
        $(document).on("change", "#general_category", function(e) {
            
            var that = $(this);
            var q = that.val();

            $("#general_subcategory").empty().append($('<option>', {
                value: '',
                text: 'Select Subcategory'
            }));

            $.each(JSON.parse(generalSubcats), function(i, item) {

                if (item.category_id == q) {
                    $("#general_subcategory").append("<option value='" + item.id + "'>" + item
                        .name + "</option>");
                }

            });

        });

        
        $(document).on('click', '.toggle-btn-for-lead-categories-add', function(e) {
            e.preventDefault();

            $(".add-new-lead-categories").toggle();
        });

        
        $(document).on('click', '.toggle-category-checkbox', function(e) {

        var that = $(this);

            if(that.is(":checked"))
            {
            that.closest('.category-area').find('.subcat-add').show();
        }
        else if(that.is(":not(:checked)"))
        {
            that.closest('.category-area').find('.subcat-add').hide();
        }
        });

        $(document).on('click', '.toggle-subcategory-radio', function(e) {
            var that = $(this);
            that.closest('.category-area').find('.subsubcat-area').hide();
            that.closest('.category-area').find('.subsubcat-area input[type="radio"]').prop('checked', false);


                if(that.is(":checked")){

                that.closest('.subcat-area').find('.subsubcat-area').show();
                }
        });

        
        });
    </script>
@endpush


