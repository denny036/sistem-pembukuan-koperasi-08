@extends('Layout.Master')

@section('title', 'Tambah Anggota - Admin')
@section('judul', 'Tambah Anggota')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('anggota') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i> Kembali</a>

    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('Protambah_anggota') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Form Tambah Anggota</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label @error('name') class="text-danger" role="alert" @enderror> Nama @error('name')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('email') class="text-danger" role="alert" @enderror> Email @error('email')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('password') class="text-danger" role="alert" @enderror> Password @error('password')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('password_confirmation') class="text-danger" role="alert" @enderror> Confirm Password @error('password_confirmation')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('tanggal_lahir') class="text-danger" role="alert" @enderror> Tanggal Lahir @error('tanggal_lahir')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('jenis_kelamin') class="text-danger" role="alert" @enderror> Jenis Kelamin @error('jenis_kelamin')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="0"> -- Pilih -- </option>
                                <option value="L"> Laki - Laki </option>
                                <option value="P"> Perempuan </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label @error('alamat') class="text-danger" role="alert" @enderror> Alamat @error('alamat')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label @error('Status_diri') class="text-danger" role="alert" @enderror> Status Diri @error('Status_diri')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <select name="Status_diri" class="form-control">
                                <option value="0"> -- Pilih --</option>
                                <option value="Singel"> Singel </option>
                                <option value="Menikah"> Menikah </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label @error('nik') class="text-danger" role="alert" @enderror> NIK @error('nik')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="text" name="nik" value="{{ old('nik') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('no_tlp') class="text-danger" role="alert" @enderror> NO Telepon @error('no_tlp')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="text" name="no_tlp" value="{{ old('no_tlp') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('no_tlpWali') class="text-danger" role="alert" @enderror> NO Telepon Wali / Istri @error('no_tlpWali')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="text" name="no_tlpWali" value="{{ old('no_tlpWali') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('foto_profil') class="text-danger" role="alert" @enderror>
                                Gambar
                                @error('foto_profil')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input class="form-control-file" type="file" name="foto_profil">
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
