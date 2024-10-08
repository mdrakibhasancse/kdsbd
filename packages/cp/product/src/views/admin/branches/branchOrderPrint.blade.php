<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Order Reports</title>
    <style type="text/css">

        @page {
          size: A4 landscape !important;
        } 

        @media all {
            * {
                font-family: "Siyamrupali";
            }

            table {
                font-size: x-small;
            }

            tfoot tr td {
                font-weight: bold;
                font-size: x-small;
            }
            .gray {
                background-color: lightgray
            }
            @font-face {
                font-family: 'Siyamrupali';
                font-style: normal;
                font-weight: normal;
                src: url({{ public_path('/fonts/Siyamrupali.ttf') }}) format('truetype');
            }

            .header-column {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .header-column>div {
                padding: 7px;
            }
            table, th,td{
                border: 1px solid rgb(227, 217, 217);
                padding: 0px;
                margin: 0px;
            }
            .footer {
                text-align: center;
            }
        }

        .no-wrap {
        white-space: nowrap;
      }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
</head>

<body class="p-3">
    <div style="width:100%; font-size:18px !important;font-weight: bold !important;">
        <div>
            <div style="">
                <div class="header-column">
                    <div>
                        <div class="d-flex justify-content-center">
                            {{-- <img src="{{ route('imagecache', ['template' => 'lh', 'filename' => $ws->logo()]) }}" alt="" /> --}}
                            <u><h3 style="font-size: 32px;">Order Reports</h3></u>
                            
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
  
    <div class="d-flex justify-content-between">
        <h6>Date :{{ Carbon\Carbon::parse(request()->date_from)->format('d-m-Y ') }} to {{Carbon\Carbon::parse(request()->date_to)->format('d-m-Y ')}}
        @if(request()->status)
        । Order Status: {{ ucfirst(request()->status) }}
        @endif

        @if(request()->mobile)
        । Mobile :{{  request()->Mobile }}.
        @endif
        </h6>
        <h6 class="font-weight-bold" style="margin-right: 25px !important;">Print Date: {{ Carbon\Carbon::now()->format('d F, Y h:i A') }}</h6>
    </div>
    <br>
    <div style="margin-top: -15px">
        <div class="table-responsive table-responsive-sm">
            <table class="table-striped table-bordered table-hover table-sm mb-1 table">
            <thead class="text-muted thead-light">
                <tr>
                <th style="width: 10px">#SL</th>
                <th>Id</th>
                <th>UserId</th>
                <th>Branch Name</th>
                <th>Date</th>
                <th>Order Status</th>
                <th>Amount</th>
                <th>Payment Status</th>
                <th>Product Items</th>
                </tr>
                
            </thead>
            <tbody class="">

                @foreach($orders as $order)
                <tr>
                <td style="width: 10px">{{$loop->iteration}}</td>
                <td>{{$order->id}}</td>
                <td>
                    {{$order->user_id ?? ''}}
                </td>
                <td>
                    {{$order->branch->name_en ?? ''}} ({{$order->branch_id}})
                </td>
                
                <td>{{$order->created_at->format('d/m/Y')}}</td>
                <td>{{$order->order_status}}</td>
                <td>{{$order->total_amount}}</td>
                <td>{{$order->payment_status}}</td>
                <td>{{$order->orderItems()->count()}}</td>
                </tr>  
                @endforeach
                <tr> 
                    {{-- <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th> --}}
                    <th colspan="7" class="text-right w3-medium">Total Amount</th>
                    <th class="w3-medium">{{ number_format($orders->sum('total_amount'), 2,);}}</th>
                    <th></th>
                   
                </tr>
            </tbody>
            </table>
        </div>
       
        <script>
            window.print()
        </script>
        

        <div class="footer">
            <b style="font-size:11px;">This Report is Generated by {{$ws->website_title}}.</b>
        </div>
    </div>
</body>

</html>
