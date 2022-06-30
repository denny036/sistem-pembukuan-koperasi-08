@extends('Layout.Master')
@push('css')

@endpush


@section('isi')
@if(Auth::user()->role == 'admin')
    @include('Admin.Dashboard_Admin')
@elseif (Auth::user()->role == 'anggota')
    @include('Anggota.Dashboard_Anggota')
@endif

@endsection


@section('modal')

    {{-- modal --}}

@endsection

@push('top-script')

@endpush

@push('page-script')

@endpush
