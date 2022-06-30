@extends('Layout.Master')

@section('title', 'Simpanan Wajib')
@section('judul', 'Simpanan Wajib')

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
        <a href="{{ route('Halaman_TambahSPMWajib') }}" class="section btn btn-info"><i class="fa fa-plus-circle"></i>
            Tambah
            Bukti Pembayaran</a>
        <a href="{{ route('printSPMW') }}" class="btn btn-danger" target="_blank"><i class="fas fa-print"></i> Print
            PDF</a>
    @else
    <a href="{{ route('AgPrintWajib') }}" class="btn btn-danger" target="_blank"><i class="fas fa-print"></i> Print
        PDF</a>
    @endif

    <hr>
    <div class="row">
        {{-- Table Simpanan Wajib --}}
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Simpanan Wajib</h4> <span class="badge badge-danger">{{ $jumlahData }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Anggota</th>
                                        <th scope="col">Jumlah Setoran</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tagihan Bulan</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($setoran as $no => $set)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $set->name }}</td>
                                            <td>{{ rupiah($set->jumlah_setoran) }}</td>
                                            <td>
                                                @if ($set->status == 'Lunas')
                                                    <p class="text-success"> {{ $set->status }}</p>
                                                @else
                                                    <p class="text-danger">{{ $set->status }}</p>
                                                @endif
                                            </td>
                                            <td>{{ $set->setoran_untukBulan }} {{ $set->tahun }}</td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#lihat{{ $set->id }}"><i
                                                        class="fas fa-eye"></i></a>
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('halaman_editSPMWajib', $set->id) }}"><i
                                                            class="fas fa-edit"></i></a>
                                                    <a href="" data-toggle="modal"
                                                        data-target="#hapus{{ $set->id }}"><i
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
    @foreach ($setoran as $ser)
        <div class="modal fade" id="lihat{{ $ser->id }}" tabdata-backdrop="static" data-keyboard="false"
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
                                <img src="{{ asset('Gambar/Admin/Simpanan Wajib/' . $ser->gambar_setoran) }}" with="400"
                                    height="400" alt="">
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Hapus Simpanan --}}
    @foreach ($setoran as $set)
        <div class="modal fade" id="hapus{{ $set->id }}" tabdata-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hapus Setoran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hapus_spm') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $set->id }}" />
                            <input type="hidden" name="key_simpanan" value="1">
                            <div class="form-group">
                                <p>Apakah Anda Yakin Ingin Menghapus Setoran Wajib dari <b>{{ $set->name }}</b>!</p>
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
