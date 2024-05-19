<div class="card card-primary card-outline" style="margin-bottom: 5px; max-height:600px;">
    <div class="card-header py-1">
        <h3 class="card-title mt-2">Media Gallery</h3>

        <div class="card-tools">
            <a href="{{ route('admin.mediasAll') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i></a>
        </div>
    </div>
    <div class="card-body datas-container bg-light py-1 px-1" data-url="{{ route('admin.getMediasAjax') }}" data-last-page="{{ $medias->lastPage() }}">
       <div class="p-3 datas-items">
        
        @includeIf('media::admin.medias.mediaAjax')

       </div>
       <div class="datas-loader" style="display: none;"><i class="fa fa-spin fa-cog"></i> Loading...</div>
    </div>
</div>




@push('js')
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js') }}"></script>

<script>
    $(document).ready(function(){

        ////////// infinite scrolling start ///////

        var showMedia = $('.datas-container');
        showMedia.slimScroll({
            height: '485px'
        });

        var pageLOC = 1;
        showMedia.scroll(function(e){

            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 20) {
            var LP = $(".datas-container").attr("data-last-page"),
                url = $(".datas-container").attr("data-url");
           
            if( pageLOC < LP )
            {
                pageLOC=pageLOC+1;
                getData(url, pageLOC);
            }else
            {
                return false;
            }

            }
        });

        function getData(url, pageLOC)
        {
            $.ajax({
                url : url + '?page=' + pageLOC,
                dataType: 'json',
                beforeSend: function()
                {
                    $(".datas-loader").show();
                },
                complete: function()
                {
                    $(".datas-loader").hide();
                },
            }).done(function (data) {
                $('.datas-items').append(data);
                // location.hash = page;
            }).fail(function () {
                $(".datas-loader").html("<p>No More Data.</p>");
            });
        }

    });

</script>
@endpush
