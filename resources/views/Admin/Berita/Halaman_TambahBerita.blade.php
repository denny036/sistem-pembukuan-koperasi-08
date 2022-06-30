@extends('Layout.Master')

@section('title', 'Tambah Berita - Admin')
@section('judul', 'Tambah Berita')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush


@section('isi')
    <a href="{{ route('berita') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i> Kembali</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <form action="{{ route('tambah_berita') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Berita</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label @error('judul') class="text-danger" role="alert" @enderror> Judul @error('judul')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input type="text" name="judul" value="{{ old('judul') }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label @error('kategori_id') class="text-danger" role="alert" @enderror> Kategori
                                @error('kategori_id')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <select class="form-control" name="kategori_id">
                                <option value="0">-- Pilih --</option>
                                @foreach ($kategori as $kate)
                                    <option value="{{ $kate->id }}">{{ $kate->kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label @error('headline') class="text-danger" role="alert" @enderror>Headline @error('headline')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <textarea name="headline" id="summernote" class="form-control">{{ old('headline') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label @error('isi') class="text-danger" role="alert" @enderror>Isi @error('isi')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <textarea name="isi" id="summernote2" class="form-control">{{ old('isi') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label @error('gambar') class="text-danger" role="alert" @enderror>Gambar @error('gambar')
                                    | {{ $message }}
                                @enderror
                            </label>
                            <input name="gambar" type="file" class="form-control">
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
