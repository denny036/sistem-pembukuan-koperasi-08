@extends('Index.LayoutAwal.Master')

@section('title', 'Home')
@section('judul', 'Home')

@push('css')
@endpush

@section('isi')
    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
        <div class="col-12 mb-12">
            <div class="hero text-white hero-bg-image hero-bg-parallax"
                data-background="{{ asset('assets/img/unsplash/koperasi.jpg') }}"
                style="background-image: url(&quot;{{ asset('/assets/img/unsplash/koperasi.jpg') }}&quot;);">
                <div class="hero-inner">
                    <h2>Selamat datang di koperasi IT Del!</h2>
                    <p class="lead">Usaha yang diselenggarakan KSU PI Del adalah mengadakan usaha simpan pinjam dan
                        pengembangan usaha di sektor pertokoan.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('login') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                                class="far fa-user"></i> Login
                            Account</a>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="section-title">Artikel</h2>
        <div class="row">
            @foreach ($berita as $ber)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ asset('Gambar/Berita/' . $ber->gambar) }}"
                                style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);">
                            </div>
                            <div class="article-title">
                                <h2><a href="{{ route('bacaBerita', $ber->id) }}">{{ $ber->judul }}</a></h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <p>{!! substr(strip_tags($ber->isi), 0, 100), '...' !!}</p>
                            <div class="article-cta">
                                <a href="{{ route('bacaBerita', $ber->id) }}" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
        <div class="col-12 mb-4">
            <div class="hero text-white hero-bg-image hero-bg-parallax"
                data-background="{{ asset('assets/img/unsplash/koperasi.jpg') }}"
                style="background-image: url(&quot;{{ asset('/assets/img/unsplash/koperasi.jpg') }}&quot;);">
                <div class="hero-inner">
                    {{-- <h2>Selamat datang di koperasi IT Del!</h2> --}}
                    <p class="lead">Unit Toko menjual beberapa kebutuhan seperti makanan & minuman ringan, alat mandi,
                        alat
                        tulis dan lainnya. Unit toko berada di kontainer Lapangan Napitupulu.
                        Usaha simpan pinjam bagi anggota usaha ini dilakukan untuk membantu anggota yang membutuhkan dana
                        baik
                        untuk tujuan keluarga, Usaha dan lainnya
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('about') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i
                                class="far fa-user"></i>
                            About
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- isi --}}
@endsection


@section('modal')

    {{-- modal --}}

@endsection

@push('top-script')
@endpush

@push('page-script')
@endpush


{{-- <h2 class="section-title">This is Example Page</h2>
            <p class="section-lead">This page is just an example for you to create your own page.</p>
            <div class="card">
              <div class="card-header">
                <h4>Example Card</h4>
              </div>
              <div class="card-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              </div>
              <div class="card-footer bg-whitesmoke">
                This is card footer
              </div>
            </div> --}}
