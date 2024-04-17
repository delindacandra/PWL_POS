@extends('layouts.template')
@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($penjualan_detail)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tablesm">
                    @foreach($penjualan_detail as $detail)
                        <tr>
                            <th>Id Penjualan</th>
                            <td>{{ $detail->penjualan->penjualan_id}}</td>
                        </tr>
                        <tr>
                            <th>Barang</th>
                            <td>{{ $detail->barang->barang_nama }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>{{ $detail->harga }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                </table>
                <table>
                    <tr>
                        <th style="padding-right: 10px;"><h2>Total Harga=</h2></th>
                        <td><h2>{{$total}}</h2></td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
