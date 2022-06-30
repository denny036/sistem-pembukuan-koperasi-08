@extends('Layout.Master')

@section('title', 'Edit Pinjaman')
@section('judul', 'Edit Pinjaman')

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
            <div class="card">
                <div class="card-header">
                    <h4>Edit Pinjaman</h4>
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
                            @foreach ($pinjaman as $ser)
                                <form action="{{ route('prosedData') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ser->id }}" />
                                    <div class="card-body">
                                        @if (Auth::user()->role == 'admin')
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
                                        @else
                                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        @endif
                                        <div class="form-group">
                                            <label @error('besar_pinjaman') class="text-danger" role="alert" @enderror>
                                                Besar Pinjaman
                                                @error('besar_pinjaman')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="number" name="besar_pinjaman" class="form-control"
                                                @if (old('besar_pinjaman')) value="{{ old('besar_pinjaman') }}"
                                                @else
                                                    value="{{ $ser->besar_pinjaman }}" @endif>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label @error('tgl_pinjaman') class="text-danger" role="alert" @enderror>
                                                    Tanggal Pinjam @error('tgl_pinjaman')
                                                        | {{ $message }}
                                                    @enderror
                                                </label>
                                                <input type="date" name="tgl_pinjaman" class="form-control"
                                                    @if (old('tgl_pinjaman')) value="{{ old('tgl_pinjaman') }}"
                                                    @else
                                                        value="{{ $ser->tgl_pinjaman }}" @endif
                                                    id="">
                                            </div>
                                            <div class="form-group col-6">
                                                <label @error('tgl_pelunasan') class="text-danger" role="alert" @enderror>
                                                    Tanggal Pelunasan @error('tgl_pelunasan')
                                                        | {{ $message }}
                                                    @enderror
                                                </label>
                                                <input type="date" name="tgl_pelunasan" class="form-control"
                                                    @if (old('tgl_pelunasan')) value="{{ old('tgl_pelunasan') }}"
                                                    @else
                                                        value="{{ $ser->tgl_pelunasan }}" @endif
                                                    id="">
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
                            <form action="{{ route('prosedfile') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach ($pinjaman as $ser)
                                    <input type="hidden" name="id" value="{{ $ser->id }}" />
                                    <div class="card-body">
                                        <iframe src="{{ asset('Pinjaman/Bukti Pinjam/' . $ser->fileBukti) }}" width="100%"
                                            height="500px">
                                        </iframe>
                                        <div class="form-group">
                                            <label @error('fileBukti') class="text-danger" role="alert" @enderror>
                                                Gambar
                                                @error('fileBukti')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input class="form-control-file" type="file" name="fileBukti" id="">
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
