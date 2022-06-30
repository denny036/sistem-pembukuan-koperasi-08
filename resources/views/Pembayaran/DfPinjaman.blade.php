@extends('Layout.Master')

@section('title', 'Daftar Pinjaman')
@section('judul', 'Daftar Pinjaman')

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
<a href="{{ route('allPembayaran') }}" class="btn btn-warning"><i class="fa-solid fa-table"></i> Semua Pembayaran</a>
<hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Pinjaman</h4> <span class="badge badge-danger">{{ $jumlahData }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
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
                                            @if ($pin->status == 'Lunas')
                                                <p class="text-success"> {{ $pin->status }}</p>
                                            @else
                                                <p class="text-danger">{{ $pin->status }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if (Auth::user()->role == 'admin')
                                                <form action="{{ route('pembayaran') }}" method="get">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $pin->user_id }}">
                                                    <input type="hidden" name="id" value="{{ $pin->id }}">
                                                    <input type="submit" class="btn btn-info"
                                                        value="+ Pembayan Pinjaman">
                                                </form>
                                            @else
                                            <form action="{{ route('pembayaran') }}" method="get">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $pin->user_id }}">
                                                <input type="hidden" name="id" value="{{ $pin->id }}">
                                                <input type="submit" class="btn btn-success"
                                                    value="Riwayat Pembayaran">
                                            </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
