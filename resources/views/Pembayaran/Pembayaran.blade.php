@extends('Layout.Master')

@section('title', 'Pembayaran')
@section('judul', 'Pembayaran')

@push('css')
@endpush

{{-- format rupiah --}}
<?php
function rupiah($angka)
{
    $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

@section('isi')
    @if (Auth::user()->role == 'admin')
        <form action="{{ route('tambahPembayaran') }}" methot="get">
            <input type="hidden" name="user_id" value="{{ $user_id }}">
            <input type="hidden" name="pinjaman_id" value="{{ $pinjaman_id }}">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Pembayaran</button>
            <a href="/print/pembayaran/{{ $user_id}}/{{ $pinjaman_id}}" class="btn btn-danger" target="_blank"><i class="fas fa-print"></i> Print PDF</a>
            <a href="{{ route('dfpeminjam') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
                Kembali</a>
        </form>
    @else
        <a href="/print/pembayaran/{{ $user_id}}/{{ $pinjaman_id}}" class="btn btn-danger" target="_blank"><i class="fas fa-print"></i> Print PDF</a>
        <a href="{{ route('dfpeminjam') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
            Kembali</a>
    @endif

    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Pembayaran {{ $user_name->name }}</h4> {{-- <span class="badge badge-danger">{{ $jumlahData }}</span> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Tanggal Bayar</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pembayaran as $no => $pem)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $pem->name }}</td>
                                            <td>{{ rupiah($pem->jumlah) }}</td>
                                            <td>{{ date('d F Y', strtotime($pem->tgl_bayar)) }}</td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#lihat{{ $pem->id }}"><i
                                                        class="fas fa-eye"></i></a>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('editPembayaran', $pem->id) }}"><i class="fas fa-edit"></i></a>
                                                    <a href="" data-toggle="modal"
                                                        data-target="#hapus{{ $pem->id }}"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- Footer Card --}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
{{-- Lihat bukti --}}
@foreach ($pembayaran as $pem)
<div class="modal fade" id="lihat{{ $pem->id }}" tabdata-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Lihat Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <img src="{{ asset('Pinjaman/Pembayaran/' . $pem->gambar_bukti) }}" with="400"
                            height="400" alt="">
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

{{-- Hapus pembayaran --}}
@foreach ($pembayaran as $pem)
<div class="modal fade" id="hapus{{ $pem->id }}" tabdata-backdrop="static" data-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hapusPembayaran') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $pem->id }}" />
                    <div class="form-group">
                        <p>Apakah Anda Yakin Ingin Menghapus Pembayaran dari <b>{{ $pem->name }}</b>!</p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batalkan</button>
                <input type="submit" class="btn btn-danger" value="Hapus">
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('top-script')
@endpush

@push('page-script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
