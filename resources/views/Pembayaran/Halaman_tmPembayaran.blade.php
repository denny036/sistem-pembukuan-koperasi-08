@extends('Layout.Master')

@section('title', 'Tambahkan Pembayaran')
@section('judul', 'Tambahkan Pembayaran')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('dfpeminjam') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
        Kembali</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('tmpembayaran') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_id }}">
                <input type="hidden" name="pinjaman_id" value="{{ $pinjaman_id }}">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambahkan Pembayaran {{ $user_name->name }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label @error('jumlah') class="text-danger" role="alert" @enderror> Jumlah
                                @error('jumlah')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="number" name="jumlah" value="{{ old('jumlah') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('tgl_bayar') class="text-danger" role="alert" @enderror> Tanggal Bayar
                                @error('tgl_bayar')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="date" name="tgl_bayar" value="{{ old('tgl_bayar') }}"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('gambar_bukti') class="text-danger" role="alert" @enderror> Upload Bukti
                                @error('gambar_bukti')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="file" name="gambar_bukti" value="{{ old('gambar_bukti') }}"
                                class="form-control-file">
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
