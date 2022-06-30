@extends('Index.LayoutAwal.Master')

@section('title', 'Informasi')
@section('judul', 'Informasi (Artikel)')

@push('css')
@endpush

@section('isi')
    <div class="row">
        @foreach ($berita as $ber)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('Gambar/Berita/' . $ber->gambar) }}"
                            style="background-image: url(&quot;../assets/img/news/img04.jpg&quot;);">
                        </div>
                        <div class="article-title">
                            <h2><a href="{{ route('bacaBerita', $ber->id) }}">{{ $ber->judul }}</a></h2>
                        </div>
                    </div>
                    <div class="article-details">
                        <p>{!! substr(strip_tags($ber->is), 0, 250), '...' !!}</p>
                        <div class="article-cta">
                            <a href="{{ route('bacaBerita', $ber->id) }}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </article>
            </div>
        @endforeach
    </div>
    {{ $berita->links('vendor.pagination.custom') }}
@endsection


@section('modal')

    {{-- modal --}}

@endsection

@push('top-script')
@endpush

@push('page-script')
@endpush
