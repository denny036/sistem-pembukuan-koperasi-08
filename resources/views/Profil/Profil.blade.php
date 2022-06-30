@extends('Layout.Master')

@section('title', 'Profil')
@section('judul', 'Profil')

@push('css')
@endpush

@section('isi')
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-6">
            {{-- profil --}}

            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" src="{{ asset('Gambar/New Akun/' . Auth::user()->foto_profil) }}"
                        class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Umur</div>
                            <div class="profile-widget-item-value">{{ $umur }}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description pb-0">
                    <div class="profile-widget-name">{{ Auth::user()->name }} <div
                            class="text-muted d-inline font-weight-normal">
                        </div>
                    </div>
                    <p>Ingatlah rasa sakit, karena rasa sakitlah yang membantu mu sampai ketahap ini
                        buktinya dengan rasa sakit yang kita terima memaksa kita menjadi apa yang kita tidak tersangka
                        dan kita dapat mencapainya bahkan terkadang menjadi lebih baik.
                    </p>
                </div>
                <div class="card-footer text-center pt-0">
                    <div class="font-weight-bold mb-2 text-small"></div>
                    <a href="#" class="btn btn-social-icon mr-1 btn-facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon mr-1 btn-twitter">
                        <i class="fab fa-twitter">s</i>
                    </a>
                    <a href="#" class="btn btn-social-icon mr-1 btn-github">
                        <i class="fab fa-github"></i>
                    </a>
                    <a href="#" class="btn btn-social-icon mr-1 btn-instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            {{-- form ganti Gambar --}}

            <div class="card">
                <div class="card-header">
                    <h4>Ubah Foto Profil</h4>
                </div>
                <form action="{{ route('editGambarProfil') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="foto_profil" class="form-control-file">
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-lg-6">

            {{-- profil lengkap  --}}

            <div class="card">
                <div class="card-header">
                  <h4>Ubah Profil</h4>
                </div>
                @foreach ($anggota as $ago)
                                <form action="{{ route('editProfilData') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ago->id }}" />
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
