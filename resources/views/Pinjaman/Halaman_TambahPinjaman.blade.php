@extends('Layout.Master')

@section('title', 'Masukkan Peminjaman')
@section('judul', 'Masukkan Peminjaamaan')

@push('css')
@endpush


@section('isi')
    @if (Auth::user()->role == 'admin')
        <a href="{{ route('pinjaman') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
            Kembali</a>
    @else
        <a href="{{ route('AgPinjam') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
            Kembali</a>
    @endif
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('prostmPinjaman') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="key_simpanan" value="1">
                <div class="card">
                    <div class="card-header">
                        <h4>Form Peminjamaan</h4>
                    </div>
                    <div class="card-body">
                        @if (Auth::user()->role == 'admin')
                            <div class="form-group">
                                <label @error('user_id') class="text-danger" role="alert" @enderror> Anggota
                                    @error('user_id')
                                        | {{ $message }}
                                    @enderror
                                </label>
                                <select class="form-control" name="user_id">
                                    <option value="0">-- Pilih --</option>
                                    @foreach ($user as $use)
                                        <option value="{{ $use->id }}">{{ $use->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @endif
                        <div class="form-group">
                            <label @error('besar_pinjaman') class="text-danger" role="alert" @enderror> Besar Pinjaman
                                @error('besar_pinjaman')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="number" name="besar_pinjaman" value="{{ old('besar_pinjaman') }}"
                                class="form-control">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label @error('tgl_pinjaman') class="text-danger" role="alert" @enderror> Tanggal Pinjam
                                    @error('tgl_pinjaman')
                                        | {{ $message }}
                                    @enderror
                                </label>
                                <input type="date" name="tgl_pinjaman" class="form-control"
                                    value="{{ old('tgl_pinjaman') }}" id="">
                            </div>
                            <div class="form-group col-6">
                                <label @error('tgl_pelunasan') class="text-danger" role="alert" @enderror> Tanggal Pelunasan
                                    @error('tgl_pelunasan')
                                        | {{ $message }}
                                    @enderror
                                </label>
                                <input type="date" name="tgl_pelunasan" class="form-control"
                                    value="{{ old('tgl_pelunasan') }}" id="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label @error('fileBukti') class="text-danger" role="alert" @enderror> Upload Surat Peminjaman
                                @error('fileBukti')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="file" name="fileBukti" value="{{ old('fileBukti') }}" class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('modal')

    {{-- modal --}}

@endsection

@push('top-script')
@endpush

@push('page-script')
@endpush
