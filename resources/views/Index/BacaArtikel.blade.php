@extends('Index.LayoutAwal.Master')

@section('title', ' Baca Artikel')
@section('judul', 'Artikel')

@push('css')
@endpush

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                <div class="card">
                    @foreach ($berita as $ber)
                        <div class="card-header">
                            <h2>{{ $ber->judul }}</h2>
                        </div>
                        <div class="card-body">
                            <p class="secondary" style="font-size: 12px">By : Admin /
                                {{ date('d F Y', strtotime($ber->updated_at)) }}</p>
                            <img class="responsive" style="width: 100%; max-width: 960px;"
                                src="{{ asset('Gambar/Berita/' . $ber->gambar) }}" alt="">
                            <p>{!! $ber->isi !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                <div class="card">
                    <div class="card-header">
                        <h6>Berita Lainnya</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($lainnya as $la)
                            <article class="article">
                                <div class="article-header">
                                    <div class="article-image"
                                        data-background="{{ asset('Gambar/Berita/' . $la->gambar) }}"
                                        style="background-image: url(&quot;../assets/img/news/img04.jpg&quot;);">
                                    </div>
                                    <div class="article-title">
                                        <h2><a style="font-size: 12px;"
                                                href="{{ route('bacaBerita', $la->id) }}">{{ $la->judul }}</a></h2>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h6>Pengumuman</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach ($pengumuman as $pe)
                                <li class="media">
                                    <div style="font-size : 30px; color : rgb(3, 3, 3)">
                                        <i class="fa-regular fa-newspaper"></i>
                                    </div>&nbsp &nbsp
                                    <div class="media-body">
                                        <p>
                                            <a style="font-size: 12px;"
                                                href="{{ route('bacaPengumuman', $pe->id) }}">{{ $pe->judul }}</a>
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')

@endsection

@push('top-script')
@endpush

@push('page-script')
@endpush
