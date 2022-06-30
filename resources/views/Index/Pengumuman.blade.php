@extends('Index.LayoutAwal.Master')

@section('title', 'Pengumuman')
@section('judul', 'Pengumuman')

@push('css')
@endpush

@section('isi')

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach ($pengumuman as $pe)
                                <li class="media">
                                    <div style="font-size : 30px; color : rgb(3, 3, 3)">
                                        <i class="fa-regular fa-newspaper"></i>
                                    </div>&nbsp &nbsp
                                    <div class="media-body">
                                        <p>
                                            <a style="font-size: 17px;"
                                                href="{{ route('bacaPengumuman', $pe->id) }}">{{ $pe->judul }}</a> <br>
                                        <label><i>By : Admin / {{ date('d F Y - H.i:s a', strtotime($pe->updated_at)) }}</i>
                                        </label>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        {{ $pengumuman->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h6>Berita (Artikel)</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($berita as $ber)
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image"
                                        data-background="{{ asset('Gambar/Berita/' . $ber->gambar) }}"
                                        style="background-image: url(&quot;../assets/img/news/img04.jpg&quot;);">
                                    </div>
                                    <div class="article-title">
                                        <h2><a style="font-size: 12px;"
                                                href="{{ route('bacaBerita', $ber->id) }}">{{ $ber->judul }}</a></h2>
                                    </div>
                                </div>
                            </article>
                        @endforeach
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
