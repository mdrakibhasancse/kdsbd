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

                       @if($lastPayment = $order->payments()->orderBy('payment_date', 'DESC')->first())
                        <p class="m-0 font-weight-bold">Due Date: {{ Carbon\Carbon::parse($lastPayment->payment_date)->format('l')}}, {{ Carbon\Carbon::parse($lastPayment->payment_date)->format('M d, Y')}}
                        </p>
                         @endif
                    </div>
                </div>

                <div class="col-4 text-center">
                    <div class=" p-2 border
                    @if($order->payment_status == 'unpaid')
                        bg-danger
                    @elseif($order->payment_status == 'paid')
                        bg-success
                    @elseif($order->payment_status == 'partial')
                    w3-light-gray
                    @endif
                    " style="min-height:100px;">

                    <p class="font-weight-bolder m-0 w3-xxxlarge">
                      {{ ucfirst($order->payment_status) }}
                    </p>


                    </div>
                </div>

            </div>

            <br>


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

            <div class="row">
                <div class="col-md-12">
                   <div class="card shadow">
                        <div class="card-header">
                            <h3 class="card-title">
                            Order Items
                            </h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="w3-small">
                                    <tr>
                                        <th style="width: 10px">#SL</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Total Cost</th>
                                    </tr>
                                </thead>
                                <tbody class="w3-small">
                            
                                    @foreach($items as $item)
                                    <tr>
                                        <td style="width: 10px">{{$loop->iteration}}</td>
                                    
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->product_price}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->total_cost}}</td>
                                    </tr>  
                                    @endforeach

                                
                                    <tr>
                
                                        <td colspan="4" class="text-right font-weight-bold">Sub Total</td>
                                        <td class="font-weight-bold">
                                             {{$order->total_amount }}
                                        </td>
                                  
                                    
                                    </tr>

                                    <tr>
                
                                        <td colspan="4" class="text-right font-weight-bold">Paid Amount</td>
                                        <td class="font-weight-bold">
                                            {{ $order->paid() }}
                                        </td>
                                    
                                    
                                    </tr>

                                    <tr>
                
                                        <td colspan="4" class="text-right font-weight-bold">Due Amount</td>
                                        <td class="font-weight-bold">
                                            {{ $order->due() }}.00
                                        </td>
                                    
                                    
                                    </tr>
                                
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
          
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header">
                          
                            <h3 class="card-title">
                              Transaction
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-responsive-sm">
                                <table class="table table-striped table-bordered">
                                    <thead class="w3-small">
                                        <th width="15">SL</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </thead>
                                    <tbody class="w3-small">
                                        @foreach($order->payments as $payment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->payment_date }}</td>
                                            <td>{{ $payment->paid_amount }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  
                   
                </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->


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

