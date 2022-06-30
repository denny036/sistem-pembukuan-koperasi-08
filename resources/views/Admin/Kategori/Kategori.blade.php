@extends('Layout.Master')

@section('title', 'Kategori - Admin')
@section('judul', 'Kategori')

@push('css')
@endpush


@section('isi')
    <div class="row">
        {{-- alert error --}}
        @error('kategori')
            <div class="col-12 col-md-12 col-lg-12">
                <div class="alert alert-danger alert-has-icon alert-dismissible show fade">
                    <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        <div class="alert-title">Danger</div>
                        Gagal karena kategori {{ $message }}
                    </div>
                </div>
            </div>
        @enderror
    </div>
    <a href="" data-toggle="modal" data-target="#tambah_kategori" class="section btn btn-info"><i
            class="fa fa-plus-circle"></i> Tambah Kategori</a>
    <hr>
    <div class="row">
        {{-- Table Kategori --}}
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Kategori</h4> <span class="badge badge-danger">{{ $jmData }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Tanggal Update</th>
                                        <th scope="col">Tanggal Dibuat</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori as $no => $kate)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $kate->kategori }}</td>
                                            <td>{{ date('d F Y', strtotime($kate->updated_at)) }}</td>
                                            <td>{{ date('d F Y', strtotime($kate->created_at)) }}</td>
                                            <td>
                                                <a href="" data-toggle="modal" data-target="#edit{{ $kate->id }}"><i
                                                        class="fas fa-edit"></i></a>
                                                <a href="" data-toggle="modal" data-target="#hapus{{ $kate->id }}"><i
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
    {{-- Modal tambah Kategori --}}
    <div class="modal fade" id="tambah_kategori" tabdata-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tambah_kategori') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label @error('kategori') class="text-danger" role="alert" @enderror> Kategori
                                    @error('kategori')
                                        | {{ $message }}
                                    @enderror </label>
                                <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" />
                            </div>
                        </div>
                        <div class="modal-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Kategori --}}
    @foreach ($kategori as $kate)
        <div class="modal fade" id="edit{{ $kate->id }}" tabdata-backdrop="static" data-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('edit_kategori') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $kate->id }}" />
                            <div class="modal-body">
                                <div class="form-group">
                                    <label @error('kategori') class="text-danger" role="alert" @enderror> Kategori
                                        @error('kategori')
                                            | {{ $message }}
                                        @enderror </label>
                                    <input type="text" name="kategori" class="form-control"
                                        @if (old('kategori')) value="{{ old('kategori') }}" @else value="{{ $kate->kategori }}" @endif>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Batalkan</button>
                        <input type="submit" class="btn btn-primary" value="Simpan">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Hapus Kategori --}}
    @foreach ($kategori as $kate)
    <div class="modal fade" id="hapus{{ $kate->id }}" tabdata-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Hapus Kategori</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('hapus_kategori') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $kate->id }}"/>
                    <div class="form-group">
                        <p>Apakah Anda Yakin Ingin Menghapus kategori <b>{{ $kate->kategori }}</b>! Karena Berita yang terkait dengat kategori ini
                        akan ikut terhapus</p>
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
