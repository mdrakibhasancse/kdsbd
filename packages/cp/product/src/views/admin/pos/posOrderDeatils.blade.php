@extends('admin::layouts.adminMaster')
@section('title')
    | Order List
@endsection

@push('css')
@endpush

@section('content') 
<section class="content py-3">
    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="card mb-2 shadow-lg">
                <div class="card-header py-2">
                    <h3 class="card-title w3-small text-bold text-muted pt-1"><i
                    class="fas fa-sitemap text-primary"></i> Pos Order Details (OrderId: &nbsp;  {{$order->id }})</h3>
                    <div class="card-tools w3-small">
                        <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('admin.posOrderPrint', $order->id) }}"><i class="fas fa-print w3-small"></i> Print</a>
                    </div>
                </div>
            </div>

            <div class="card w3-round mb-2 shadow-lg">
                <div class="card-body px-2 py-2 w3-light-gray">
            
                    <div class="card-deck">
                    
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <img  class="w3-100 w3-round" src="{{ route('imagecache', [ 'template'=>'cpxxxs','filename' => $ws->logo() ]) }}" alt="kdsbdLogo">
                                <address>
                                {{$ws->website_title}}<br>
                                {{$ws->contact_address}}<br>
                                Phone: {{$ws->contact_mobile}}<br>
                                Email: {{$ws->contact_email}}
                                </address>
                            </div>
                        </div>
                    
                        <div class="card shadow">
                            <div class="card-body">
                            <address>
                                <strong>Order Info</strong><br>
                                Order Id: {{$order->id}}<br>
                                Order Date: {{$order->created_at->format('d/m/Y')}}
                                @if($order->user)
                                <br>
                                Order By:
                                {{$order->user->name ?? ''}} ({{$order->user->mobile ?? ''}})<br>
                                Email: {{$order->user->mobile ?? ''}}
                                @endif
                                <br>
                                Branch: {{$order->branch->name_en ?? ''}}<br>
                            </address>
                            </div>
                        </div>
                    </div>
                    <br>
                        
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
                </div>
            </div>
           
        </div>
    </div>
</section>


   
@endsection


@push('js')



@endpush




