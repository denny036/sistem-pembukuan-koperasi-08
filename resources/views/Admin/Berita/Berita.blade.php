@extends('Layout.Master')

@section('title', 'Berita - Admin')
@section('judul', 'Berita')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('halaman_tambahBerita') }}" class="section btn btn-info"><i class="fa fa-plus-circle"></i> Tambah
        Berita</a>
    <hr>
    <div class="row">
        {{-- Table Berita --}}
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Berita</h4> <span class="badge badge-danger">{{ $jmBerita }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Tanggal Update</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($berita as $no => $ber)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td><img src="{{ asset('Gambar/Berita/' . $ber->gambar) }}" width="100"
                                                    height="80" alt=""></td>
                                            <td>{{ $ber->judul }}</td>
                                            <td>{{ $ber->kategori }}</td>
                                            <td>{{ date('d F Y', strtotime($ber->updated_at)) }}</td>
                                            <td>{{ date('d F Y', strtotime($ber->created_at)) }}</td>
                                            <td>
                                                <a href="{{ route('halaman_editBerita',$ber->id) }}"><i class="fas fa-edit"></i></a>
                                                <a href="" data-toggle="modal" data-target="#hapus{{ $ber->id }}"><i
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
    {{-- Hapus Berita --}}
    @foreach ($berita as $ber)
        <div class="modal fade" id="hapus{{ $ber->id }}" tabdata-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Hapus Berita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hapus_berita') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $ber->id }}" />
                            <div class="form-group">
                                <p>Apakah Anda Yakin Ingin Menghapus Berita <b>{{ $ber->judul }}</b>!</p>
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
