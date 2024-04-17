@extends('layouts.template')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $page->title_barang }}</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-error">{{ session('error') }}</div>
                    @endif

                    <table class="table-bordered table-striped table-hover table-sm table" id="table_barang">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($barang as $barang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $barang->barang_nama }}</td>
                                    <td>{{ $barang->harga_jual }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm tambah-barang"
                                            data-id="{{ $barang->barang_id }}" data-nama="{{ $barang->barang_nama }}"
                                            data-harga="{{ $barang->harga_jual }}">Tambah</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @push('css')
        @endpush

        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ $page->title }}</h3>
                    <div class="card-tools"></div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label class="col-3 control-label col-form-label">Staff</label>
                            <div class="col-9">
                                <select class="form-control" id="user_id" name="user_id" required>
                                    <option value="">- Pilih User -</option>
                                    @foreach ($user as $item)
                                        <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 control-label col-form-label">Nama Pembeli</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="pembeli" name="pembeli"
                                    value="{{ old('pembeli') }}" required>
                                @error('pembeli')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 control-label col-form-label">Kode Penjualan</label>
                            <div class="col-9">
                                <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                                    value="{{ old('penjualan_kode') }}" required>
                                @error('penjualan_kode')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 control-label col-form-label">Tanggal Penjualan</label>
                            <div class="col-9">
                                <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                                    value="{{ old('penjualan_tanggal') }}" required>
                                @error('penjualan_tanggal')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <table class="table-bordered table-striped table-hover table-sm" id="table_transaksi">
                            <thead>
                                <tr>
                                    <th>ID Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="form-group row">
                            <label class="col-3 control-label col-form-label">Total Harga</label>
                            <div class="col-9">
                                <h4><span id="total_harga" class="form-control-static">0,00</span></h4>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-3 control-label col-form-label"></label>
                            <div class="col-9">
                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $('.tambah-barang').click(function() {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var harga = $(this).data('harga');

            // Cek barang sudah ada di tabel transaksi atau belum
            var existingRow = $('#table_transaksi tbody tr[data-id="' + id + '"]');
            if (existingRow.length > 0) {
                // Jika barang sudah ada
                var jumlah = parseInt(existingRow.find('.jumlah').val());
                existingRow.find('.jumlah').val(jumlah + 1);
            } else {
                // Jika barang belum ada, tambah
                $('#table_transaksi tbody').append('<tr data-id="' + id + '"><td>' + id + '</td><td>' +
                    nama + '</td><td class="harga">' +
                    harga +
                    '</td><td><input type="number" class="form-control jumlah" value="1" min="1"></td></tr>'
                );
            }
            hitungTotalHarga();
        });

        $('#table_transaksi').on('change', '.jumlah', function() {
            hitungTotalHarga();
        });

        function hitungTotalHarga() {
            var total = 0;
            $('#table_transaksi tbody tr').each(function() {
                var harga_barang = parseFloat($(this).find('.harga').text());
                var jumlah_barang = parseInt($(this).find('.jumlah').val());
                var subtotal = harga_barang * jumlah_barang;
                total += subtotal;
            });

            // Menggunakan toLocaleString() untuk menambahkan titik pada setiap tiga angka terakhir
            var formattedTotal = total.toLocaleString('id-ID', {
                minimumFractionDigits: 2
            });
            $('#total_harga').text(formattedTotal);
        }
    </script>
@endpush
