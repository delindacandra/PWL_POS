<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PenjualanDetailModel;
use App\Models\PenjualanModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    protected $detailPenjualanController;

    public function __construct(DetailPenjualanController $detailPenjualanController)
    {
        $this->detailPenjualanController = $detailPenjualanController;
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi penjualan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penjualan';

        $user = UserModel::all();

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualans = PenjualanModel::select('penjualan_id', 'user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->with('user');

        if ($request->user_id) {
            $penjualans->where('user_id', $request->user_id);
        }

        return DataTables::of($penjualans)

            ->addIndexColumn()

            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="' . url('/penjualan/' . $penjualan->penjualan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/penjualan/' . $penjualan->penjualan_id . '/edit') . '"class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/penjualan/' . $penjualan->penjualan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Tambah']
        ];

        $barang = BarangModel::all();
        $page = (object) [
            'title_barang' => 'Daftar Barang',
            'title' => 'Tambah transaksi penjualan baru'
        ];

        $user = UserModel::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:50',
            'penjualan_tanggal' => 'required|date',
            'barang' => 'required|array',
            'jumlah' => 'required|array',
            'harga' => 'required|array',
        ]);

        $penjualan = PenjualanModel::create([
            'user_id' => $request->user_id,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
            'pembeli' => $request->pembeli
        ]);
        PenjualanDetailModel::create([
            'penjualan_id' => $penjualan,
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil ditambahkan');
    }


    public function show(string $id)
    {
        $penjualan_detail = PenjualanDetailModel::where('penjualan_id', $id)->get();
        if (!$penjualan_detail) {
            return redirect('/penjualan')->with('error', 'Detail penjualan tidak ditemukan');
        }
        $total = 0;
        foreach ($penjualan_detail as $detail) {
            $total += $detail->harga * $detail->jumlah;
        }

        $penjualan = PenjualanModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan_detail';

        return view('penjualan.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan_detail' => $penjualan_detail, 'total' => $total, 'penjualan' => $penjualan, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $penjualan = PenjualanModel::find($id);
        $user = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Edit Transaksi Penjualan',
            'list' => ['Home', 'Transaksi Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'penjualan' => $penjualan, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|string|max:10|unique:t_penjualan,penjualan_kode,' . $id . ',user_id',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string',
            'penjualan_tanggal' => 'required|date'
        ]);

        PenjualanModel::find($id)->update([
            'user_id' => $request->user_id,
            'pembeli' => $request->pembeli,
            'penjualan_kode' => $request->penjualan_kode,
            'penjualan_tanggal' => $request->penjualan_tanggal,
        ]);

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = PenjualanModel::find($id);
        if (!$check) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        try {
            PenjualanModel::destroy($id);
            return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
