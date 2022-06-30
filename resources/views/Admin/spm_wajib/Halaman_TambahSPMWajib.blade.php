@extends('Layout.Master')

@section('title', 'Tambah Simpanan Wajib - Admin')
@section('judul', 'Tambah Simpanan Wajib')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('simpanan_wajib') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
        Kembali</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('tambah_simpananWajib') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="key_simpanan" value="1">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Simpanan Wajib</h4>
                    </div>
                    <div class="card-body">
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
                        <div class="form-group">
                            <label @error('jumlah_setoran') class="text-danger" role="alert" @enderror> Jumlah Setoran
                                @error('jumlah_setoran')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="number" name="jumlah_setoran" value="{{ old('jumlah_setoran') }}"
                                class="form-control">
                        </div>
                        <div class="row">
                            <div class="form-group col-6">
                                <label @error('setoran_untukBulan') class="text-danger" role="alert" @enderror> Setoran
                                    Untuk
                                    Bulan @error('setoran_untukBulan')
                                        | {{ $message }}
                                    @enderror
                                </label>
                                <select class="form-control" name="setoran_untukBulan">
                                    <option value="0">-- Pilih --</option>
                                    @foreach ($bulan as $bu)
                                        <option value="{{ $bu->name }}">{{ $bu->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label @error('tahun') class="text-danger" role="alert" @enderror> Tahun @error('tahun')
                                        | {{ $message }}
                                    @enderror
                                </label>
                                <input type="number" name="tahun" value="{{ old('tahun') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label @error('gambar_setoran') class="text-danger" role="alert" @enderror> Upload Bukti
                                @error('gambar_setoran')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="file" name="gambar_setoran" value="{{ old('gambar_setoran') }}"
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
