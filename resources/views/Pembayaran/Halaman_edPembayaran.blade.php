@extends('Layout.Master')

@section('title', 'Edit Simpanan Pembayaran')
@section('judul', 'Edit Simpanan Pembayaran')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('dfpeminjam') }}" class="section btn btn-info"><i class="fas fa-arrow-circle-left"></i>
        Kembali</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Pembayaran</h4>
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
                            @foreach ($pembayaran as $pem)
                                <form action="{{ route('editDataPembayaran') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $pem->id }}" />
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label @error('jumlah') class="text-danger" role="alert" @enderror> Jumlah
                                                @error('jumlah')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="number" name="jumlah" class="form-control"
                                                @if (old('jumlah')) value="{{ old('jumlah') }}"
                                            @else
                                                value="{{ $pem->jumlah }}" @endif>
                                        </div>
                                        <div class="form-group">
                                            <label @error('tgl_bayar') class="text-danger" role="alert" @enderror> Tanggal
                                                Bayar
                                                @error('tgl_bayar')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input type="date" name="tgl_bayar" class="form-control"
                                                @if (old('tgl_bayar')) value="{{ old('tgl_bayar') }}"
                                            @else
                                                value="{{ $pem->tgl_bayar }}" @endif>
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
                            <form action="{{ route('editGambarPembayaran') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @foreach ($pembayaran as $pem)
                                    <input type="hidden" name="id" value="{{ $pem->id }}" />
                                    <div class="card-body">
                                        <img src="{{ asset('Pinjaman/Pembayaran/' . $pem->gambar_bukti) }}"
                                            width="400" height="300" alt="">
                                        <div class="form-group">
                                            <label @error('gambar_bukti') class="text-danger" role="alert" @enderror>
                                                Gambar
                                                @error('gambar_bukti')
                                                    | {{ $message }}
                                                @enderror
                                            </label>
                                            <input class="form-control-file" type="file" name="gambar_bukti" id="">
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
