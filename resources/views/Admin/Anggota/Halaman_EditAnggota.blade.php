@extends('Layout.Master')

@section('title', 'Edit Anggota - Admin')
@section('judul', 'Edit Anggota')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('anggota') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i> Kembali</a>

    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Anggota</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab5" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab5" data-toggle="tab" href="#data" role="tab"
                                aria-controls="home" aria-selected="true">
                                <i class="fas fa-database"></i> Data</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab5" data-toggle="tab" href="#gambar" role="tab"
                                aria-controls="profile" aria-selected="false">
                                <i class="fas fa-image"></i> Gambar</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent5">
                        <div class="tab-pane fade show active" id="data" role="tabpanel" aria-labelledby="home-tab5">
                            @foreach ($anggota as $ago)
                                <form action="{{ route('update_anggota') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @foreach ($user as $use)
                                        <input type="hidden" name="id" value="{{ $use->id }}" />
                                    @endforeach
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label @error('name') class="text-danger" role="alert" @enderror> Nama
                                                @error('name')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="text" class="form-control" name="name"
                                                @if (old($ago->name)) value="{{ old($ago->name) }}"
                                            @else
                                                value="{{ $ago->name }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label @error('tanggal_lahir') class="text-danger" role="alert" @enderror>
                                                Tanggal Lahir
                                                @error('tanggal_lahir')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="date" name="tanggal_lahir" id="" class="form-control"
                                                @if (old('tanggal_lahir')) value="{{ old('tanggal_lahir') }}"
                                            @else
                                                value="{{ $ago->tanggal_lahir }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label @error('jenis_kelamin') class="text-danger" role="alert" @enderror>
                                                Jenis Kelamin
                                                @error('jenis_kelamin')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <select class="form-control" name="jenis_kelamin">
                                                @if ($ago->jenis_kelamin == '0')
                                                    <option value="0"> -- Pilih -- </option>
                                                    <option value="L"> Laki - Laki </option>
                                                    <option value="P"> Perempuan </option>
                                                @else
                                                    <option value="{{ $ago->jenis_kelamin }}">
                                                        @if ($ago->jenis_kelamin == 'P')
                                                            Perempuan
                                                        @elseif ($ago->jenis_kelamin == 'L')
                                                            Laki - Laki
                                                        @endif
                                                    </option>
                                                    @if ($ago->jenis_kelamin == 'L')
                                                        <option value="P"> Perempuan </option>
                                                    @elseif ($ago->jenis_kelamin == 'P')
                                                        <option value="L"> Laki - Laki </option>
                                                    @else
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label @error('alamat') class="text-danger" role="alert" @enderror> Alamat
                                                @error('alamat')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <textarea name="alamat" id="" class="form-control">
                                                @if (old($ago->alamat))
{{ old($ago->alamat) }}
@else
{{ $ago->alamat }}
@endif
                                            </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label @error('Status_diri') class="text-danger" role="alert" @enderror> Status
                                                Diri
                                                @error('Status_diri')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <select name="Status_diri" class="form-control">
                                                @if ($ago->Status_diri == '0')
                                                    <option value="0"> -- Pilih --</option>
                                                    <option value="Singel"> Singel </option>
                                                    <option value="Menikah"> Menikah </option>
                                                @else
                                                    <option value="{{ $ago->Status_diri }}">{{ $ago->Status_diri }}
                                                    </option>
                                                    @if ($ago->Status_diri == 'Singel')
                                                        <option value="Menikah"> Menikah </option>
                                                    @elseif ($ago->Status_diri == 'Menikah')
                                                        <option value="Singel"> Singel </option>
                                                    @else
                                                    @endif
                                                @endif
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label @error('nik') class="text-danger" role="alert" @enderror> NIK
                                                @error('nik')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="text" name="nik" id="" class="form-control"
                                                @if (old('nik')) value="{{ old('nik') }}"
                                            @else
                                                value="{{ $ago->nik }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label @error('no_tlp') class="text-danger" role="alert" @enderror> No Telepon
                                                @error('no_tlp')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="text" name="no_tlp" id="" class="form-control"
                                                @if (old('no_tlp')) value="{{ old('no_tlp') }}"
                                            @else
                                                value="{{ $ago->no_tlp }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label @error('no_tlpWali') class="text-danger" role="alert" @enderror> No
                                                Telepon Wali / Istri
                                                @error('no_tlpWali')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="text" name="no_tlpWali" id="" class="form-control"
                                                @if (old('no_tlpWali')) value="{{ old('no_tlpWali') }}"
                                            @else
                                                value="{{ $ago->no_tlpWali }}" @endif>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="gambar" role="tabpanel" aria-labelledby="profile-tab5">
                            <form action="{{ route('update_gambar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach ($user as $ser)
                                    <input type="hidden" name="id" value="{{ $ser->id }}" />
                                    <div class="card-body">
                                        <img src="{{ asset('Gambar/New Akun/' . $ser->foto_profil) }}" width="400"
                                            height="300" alt="">
                                        <div class="form-group">
                                            <label @error('foto_profil') class="text-danger" role="alert" @enderror>
                                                Gambar
                                                @error('foto_profil')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input class="form-control-file" type="file" name="foto_profil" id="">
                                        </div>

                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
