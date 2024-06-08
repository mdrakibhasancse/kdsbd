<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Invoice # {{ $order->id }}</title>


  <link rel="stylesheet" href="{{ asset('https://www.w3schools.com/w3css/4/w3.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}alt/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}alt/dist/css/adminlte.min.css">

  <style type="text/css">

      @media print {
        body {-webkit-print-color-adjust: exact;}
        }

  </style>
</head>
<body>


<div class="wrapper">
    <div class="container">
        <!-- Main content -->
        <section>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="page-header m-0 p-0">
                        <div class="row">
                            <div class="col-1">
                                @if($ws->logo())
                                <img  class="img-thumbnail" src="{{ route('imagecache', [ 'template'=>'lh','filename' => $ws->logo() ]) }}" alt="kdsbd_logo">
                            @endif
                            </div>
                            <div class="col-11">
                                <p class=" w3-xxlarge m-0 mt-n2 font-weight-bold">{{ $ws->website_title }}</p>
                                <p class="w3-small mt-n2 font-weight-bold">{{ $ws->contact_address }}</p>
                                <small class="float-right">Date: {{ date('d/m/Y') }}</small>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            <!-- /.col -->
            </div>
        

            <br>

            <div class="row">
                <div class="col-8">
                    <div class= "p-2 border" style="background: #ddd;">
                        <p class="font-weight-bolder m-0 w3-large">Invoice #{{ $order->id }}</p>
                        <p class="m-0 font-weight-bold">Invoice Date: {{ Carbon\Carbon::parse($order->created_at)->format('l')}}, {{ Carbon\Carbon::parse($order->created_at)->format('M d, Y')}} </p>
                    </div>
                </div>

                <div class="col-4 text-center">
                    <div class="p-1 border" style="min-height:67px;">

                    <p class="font-weight-bolder m-0 w3-xxlarge">
                      {{ ucfirst($order->payment_status) }}
                    </p>


                    </div>
                </div>

            </div>

            <br>

            @if($order->user)
            <div class="row">
                <div class="col-8">  
                    <p class="w3-large m-0 font-weight-bold"> Invoiced To</p>
                    <dl class="row">
                        <dt class="col-sm-2">Name:</dt>
                        <dd class="col-sm-10 w3-light-gray mb-1">{{ $order->user->name ?? '' }}</dd>

                        <dt class="col-sm-2">Email:</dt>
                        <dd class="col-sm-10 w3-light-gray mb-1">{{ $order->user->email ?? '' }}</dd>

                        <dt class="col-sm-2">Mobile:</dt>
                        <dd class="col-sm-10 w3-light-gray mb-1">{{ $order->user->mobile ?? '' }}</dd>
                    </dl>
                </div>
            </div>
            <br>
            @endif

            @if($order->orderItems()->count() > 0)
                <div class="card">
                    <div class="table-responsive posItemModule">
                        @csrf
                        <table class="table table-no-pm table-condensed table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th class="text-center">Product Name</th>
                                <th class="text-center">Product Code</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Sale Price</th>
                                <th class="text-center">Total Amount</th>
                            </tr>
                            </thead>
                            <tbody class="moduleItems">
                                <?php $i = 1; ?>
                                @forelse($order->orderItems as $item)
                                <tr class="">
                                    <td>{{ $i }}</td>
                                    <td title="Tarmeric Powder 200gm">{{Str::Limit($item->product_name , 12 , '...')}}</td>
                                    <td>{{$item->product_code ?? ''}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->unit_price}}</td>
                                    <td>{{$item->total_price}}</td>
                                    
                                </tr>
                                <?php $i++; ?>
                                @empty

                                @endforelse
                            </tbody>

                            <tfoot>
                                <tr>
                                <th colspan="5" class="text-right">Sub Total (TK)</th>
                                <th colspan="3" class="w3-light-gray">
                                    {{ $order->total_price}}
                                </th>
                                </tr>


                                <tr>
                                <th colspan="5" class="text-right">Mobile</th>
                                <th colspan="3" class="w3-light-gray">
                                    {{ $order->mobile ?? ''}}
                                </th>
                                </tr>
                                
                                <tr>
                                <th colspan="5" class="text-right">Discount (TK)</th>
                                <th colspan="3" class="w3-light-gray">
                                    {{ $order->total_discount}}
                                </div>
                                </th>
                                </tr>

                                <tr>
                                <th colspan="5" class="text-right">Grand Total (TK)</th>
                                <th colspan="3" class="w3-light-gray">
                                    {{ $order->final_price}} 
                                </div>
                                </th>
                                </tr>

                                <tr>
                                <th colspan="5" class="text-right">Paid (TK)</th>
                                <th colspan="3" class="w3-light-gray">
                                    {{ $order->paid_amount}} 
                                </th>
                                </tr>

                            </tfoot>
                        </table>
                    </form>
                    </div>
                </div>
            @endif


            <br> <br>
            <div class="row">
                <div class="col-12">

                    <div class="text-center">
                       PDF Generated on {{ Carbon\Carbon::now()->format('l')}}, {{ Carbon\Carbon::now()->format('M d, Y')}}
                    </div>

                </div>
            </div>

            <br>


        </section>
    </div>
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>

