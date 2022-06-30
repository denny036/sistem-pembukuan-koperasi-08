@extends('Layout.Master')

@section('title', 'Pinjaman')
@section('judul', 'Pinjaman')

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
<a href="{{ route('tambahPinjaman') }}" class="section btn btn-info"><i class="fa fa-plus-circle"></i> Tambah Peminjaman</a>
<a href="{{ route('AgPinjamPrint') }}" class="btn btn-danger" target="_blank"><i class="fas fa-print"></i> Print PDF</a>
<hr>
<div class="row">
    {{-- Table Simpanan Wajib --}}
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Table Peminjam</h4> <span class="badge badge-danger">{{ $jumlahData }}</span>
            </div>
            <div class="card-body">
                <div class="table-responsive p-3">
                    <form action="" method="post">
                        <table id="example" class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Besar Pinjaman</th>
                                    <th scope="col">Tanggal Pinjam</th>
                                    <th scope="col">Tanggal Pelunasan</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinjaman as $no => $pin)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $pin->name }}</td>
                                        <td>{{ rupiah($pin->besar_pinjaman) }}</td>
                                        <td>{{ date('d F Y', strtotime($pin->tgl_pinjaman)) }}</td>
                                        <td>{{ date('d F Y', strtotime($pin->tgl_pelunasan)) }}</td>
                                        <td>
                                            @if ($pin->status == "Lunas")
                                                <p class="text-success"> {{ $pin->status }}</p>
                                            @else
                                                <p class="text-danger">{{ $pin->status }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('download', $pin->fileBukti) }}"><i class="fa-solid fa-download"></i></a>
                                            <a href="{{ asset('Pinjaman/Bukti Pinjam/'.$pin->fileBukti) }}" target="_blank"><i
                                                    class="fas fa-eye"></i></a>
                                            <a href="{{ route('editPinjaman', $pin->id) }}"><i
                                                    class="fas fa-edit"></i></a>
                                            <a href="" data-toggle="modal" data-target="#hapus{{ $pin->id }}"><i
                                                    class="fas fa-trash-alt"></i></a>
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
@foreach ($pinjaman as $set)
        <div class="modal fade" id="hapus{{ $set->id }}" tabdata-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hapus Pinjaman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hapus_pinjaman') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $set->id }}" />
                            <div class="form-group">
                                <p>Apakah Anda Yakin Ingin Menghapus Pinjaman dari <b>{{ $set->name }}</b>!</p>
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
