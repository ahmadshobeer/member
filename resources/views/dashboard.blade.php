@extends('layouts.layout')

@section('content')
<div class="container-fluid p-0">

    <h1 class="h3 mb-3"><strong>Halo,</strong> {{ strtoupper($nm_pelanggan)}}</h1>

    <div class="row">
        <div class="col-xl-6 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <h5 class="card-title">Total Tagihan</h5>
                                    </div>

                                    <div class="col-auto">
                                        <div class="stat text-primary">
                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                                <h2 class="mt-1 mb-3">Rp. {{number_format($tagihan->total)}}</h1>
                                <div class="mb-0">
                                    @if($tagihan->terbayar =='Y')
                                        <span class="badge bg-success"> SUDAH TERBAYAR </span>         
                                    @else
                                        <span class="badge bg-danger"> BELUM TERBAYAR </span>        
                                    @endif
                                 
                                </div> 
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>

         <div class="col-xl-6 col-xxl-7">
            {{-- <div class="card flex-fill w-100">
                <div class="card-header">

                    <h5 class="card-title mb-0">Riwayat Pembayaran</h5>
                </div>
                <div class="card-body py-3">
                    <div class="table-responsive">
                        <table class="table table-borderless my-0 datatables">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tunggakan</th>
                                    <th>Tagihan</th>
                                    <th>Diskon</th>
                                    <th>Total</th>
                                    <th>Nominal Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayaran as $history)
                                <tr>
                                    <td>{{ $history->tgl}}</td>
                                    <td>{{ $history->tunggakan}}</td>
                                    <td>{{ $history->tagihan}}</td>
                                    <td>{{ $history->diskon}}</td>
                                    <td>{{ $history->total}}</td>
                                    <td>{{ $history->nominal}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
            </div> --}}
        </div> 
    </div>
    <div class="row">
        <div class="card flex-fill w-100">
            <div class="card-header">

                <h5 class="card-title mb-0">Riwayat Pembayaran</h5>
            </div>
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-borderless my-0 datatables">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tunggakan</th>
                                <th>Tagihan</th>
                                <th>Diskon</th>
                                <th>Total</th>
                                <th>Nominal Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $history)
                            <tr>
                                <td>{{ $history->tgl}}</td>
                                <td style="text-align: right">{{ number_format($history->tunggakan) }}</td>
                                <td style="text-align: right">{{ number_format($history->tagihan) }}</td>
                                <td style="text-align: right">{{ number_format($history->diskon) }}</td>
                                <td style="text-align: right">{{ number_format($history->total) }}</td>
                                <td style="text-align: right">{{ number_format($history->nominal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>

</div>
@endsection

