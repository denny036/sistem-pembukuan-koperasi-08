@extends('Layout.Master')

@section('title', 'Edit Berita - Admin')
@section('judul', 'Edit Berita')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush


@section('isi')
    <a href="{{ route('berita') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Berita</h4>
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
                        <div class="tab-pane fade active show" id="data" role="tabpanel" aria-labelledby="home-tab5">
                            {{-- Edit Data --}}
                            <form action="{{ route('edit_dataBerita') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach ($berita as $ber)
                                    <input type="hidden" name="id" value="{{ $ber->id }}" />
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label @error('judul') class="text-danger" role="alert" @enderror> Judul
                                                @error('judul')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="text" name="judul" class="form-control"
                                                @if (old('judul')) value="{{ old('judul') }}"
                                    @else
                                        value="{{ $ber->judul }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label @error('kategori_id') class="text-danger" role="alert" @enderror>
                                                Kategori
                                                @error('kategori_id')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <select class="form-control" name="kategori_id">
                                                <option value="{{ $ber->kategori_id }}">{{ $ber->kategori }}
                                                </option>
                                                @foreach ($kategori as $kate)
                                                    @if ($ber->kategori_id == $kate->id)
                                                    @else
                                                        <option value="{{ $kate->id }}">{{ $kate->kategori }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label @error('headline') class="text-danger" role="alert" @enderror>Headline
                                                @error('headline')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <textarea name="headline" id="summernote" class="form-control">
        @if (old('headline'))
{{ old('headline') }}
@else
{{ $ber->headline }}
@endif
        </textarea>
                                        </div>
                                        <div class="form-group">
                                            <label @error('isi') class="text-danger" role="alert" @enderror>Isi
                                                @error('isi')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <textarea name="isi" id="summernote2" class="form-control">
        @if (old('isi'))
{{ old('isi') }}
@else
{{ $ber->isi }}
@endif
        </textarea>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                        <div class="tab-pane fade" id="gambar" role="tabpanel" aria-labelledby="profile-tab5">
                            <form action="{{ route('edit_gambarBerita') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach ($berita as $ber)
                                    <input type="hidden" name="id" value="{{ $ber->id }}" />
                                    <div class="card-body">
                                        <img src="{{ asset('Gambar/Berita/'.$ber->gambar) }}" width="400" height="300" alt="">
                                        <div class="form-group">
                                            <label @error('gambar') class="text-danger" role="alert" @enderror> Gambar
                                                @error('gambar')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input class="form-control-file" type="file" name="gambar" id="">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $('#summernote').summernote({
            tabsize: 2,
            height: 200
        });
    </script>
    <script>
        $('#summernote2').summernote({
            tabsize: 2,
            height: 200
        });
    </script>
@endpush
