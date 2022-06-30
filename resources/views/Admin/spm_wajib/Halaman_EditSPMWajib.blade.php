@extends('Layout.Master')

@section('title', 'Edit Simpanan Wajib - Admin')
@section('judul', 'Edit Simpanan Wajib')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('simpanan_wajib') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
        Kembali</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Simpanan Wajib</h4>
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
                            @foreach ($setoran as $ser)
                                <form action="{{ route('edit_spmData') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ser->id }}" />
                                    <input type="hidden" name="key_simpanan" value="1">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label @error('user_id') class="text-danger" role="alert" @enderror> Anggota
                                                @error('user_id')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <select class="form-control" name="user_id">
                                                <option value="{{ $ser->user_id }}">{{ $ser->name }}</option>
                                                @foreach ($user as $use)
                                                    @if ($ser->user_id == $use->id)
                                                    @else
                                                        <option value="{{ $use->id }}">{{ $use->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label @error('jumlah_setoran') class="text-danger" role="alert" @enderror>
                                                Jumlah Setoran
                                                @error('jumlah_setoran')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="number" name="jumlah_setoran" class="form-control"
                                                @if (old('jumlah_setoran')) value="{{ old('jumlah_setoran') }}"
                                                @else
                                                    value="{{ $ser->jumlah_setoran }}" @endif>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label
                                                    @error('setoran_untukBulan') class="text-danger" role="alert" @enderror>
                                                    Setoran Untuk
                                                    Bulan @error('setoran_untukBulan')
                                                        | {{ $message }}
                                                    @enderror
                                                </label>
                                                <select class="form-control" name="setoran_untukBulan">
                                                    <option value="{{ $ser->setoran_untukBulan }}">
                                                        {{ $ser->setoran_untukBulan }}</option>
                                                    @foreach ($bulan as $bul)
                                                        @if ($ser->setoran_untukBulan == $bul->name)
                                                        @else
                                                            <option value="{{ $bul->name }}">{{ $bul->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-6">
                                                <label @error('tahun') class="text-danger" role="alert" @enderror> Tahun @error('tahun')
                                                        | {{ $message }}
                                                    @enderror
                                                </label>
                                                <input type="number" name="tahun" @if (old($ser->tahun))
                                                    value="{{ old('tahun') }}"
                                                @else
                                                    value="{{ $ser->tahun }}"
                                                @endif class="form-control">
                                            </div>
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
                            <form action="{{ route('edit_spmGambar') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach ($setoran as $ser)
                                    <input type="hidden" name="id" value="{{ $ser->id }}" />
                                    <input type="hidden" name="key_simpanan" value="1">
                                    <div class="card-body">
                                        <img src="{{ asset('Gambar/Admin/Simpanan Wajib/' . $ser->gambar_setoran) }}"
                                            width="400" height="300" alt="">
                                        <div class="form-group">
                                            <label @error('gambar_setoran') class="text-danger" role="alert" @enderror>
                                                Gambar
                                                @error('gambar_setoran')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input class="form-control-file" type="file" name="gambar_setoran" id="">
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
