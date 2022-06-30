@extends('Layout.Master')

@section('title', 'Pengumuman - Admin')
@section('judul', 'Pengumuman')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('halaman_tambahPengumuman') }}" class="section btn btn-info"><i class="fa fa-plus-circle"></i> Tambah
        Pengumuman</a>
    <hr>

    <div class="row">
        {{-- Table Pengumuman --}}
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Pengumuman</h4> <span class="badge badge-danger">{{ $jmPengumuman }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Tanggal Update</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengumuman as $no => $pe)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $pe->judul }}</td>
                                            <td>{{ date('d F Y', strtotime($pe->updated_at)) }}</td>
                                            <td>{{ date('d F Y', strtotime($pe->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('halaman_editPengumuman', $pe->id) }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="" data-toggle="modal" data-target="#hapus{{ $pe->id }}"><i
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
    {{-- Hapus Pengumuman --}}
    @foreach ($pengumuman as $pe)
        <div class="modal fade" id="hapus{{ $pe->id }}" tabdata-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hapus Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hapus_pengumuman') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $pe->id }}" />
                            <div class="form-group">
                                <p>Apakah Anda Yakin Ingin Menghapus Pengumuman <b>{{ $pe->judul }}</b>!</p>
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

    {{-- Lihat Pengumuman --}}
    @foreach ($pengumuman as $pe)
        <div class="modal fade" id="lihat{{ $pe->id }}" tabdata-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Lihat Pengumuman</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <p>{!! $pe->isi !!}</p>
                            </div>
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
