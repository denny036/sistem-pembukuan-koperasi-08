@extends('Layout.Master')

@section('title', 'Anggota - Admin')
@section('judul', 'Anggota')

@push('css')
@endpush


@section('isi')
    <a href="{{ route('tambah_anggota') }}" class="section btn btn-info"><i class="fa fa-plus-circle"></i> Tambah
        Anggota</a>
    <hr>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Table Anggota</h4> <span class="badge badge-danger">{{ $jmAnggota }}</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive p-3">
                        <form action="" method="post">
                            <table id="example" class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">No Telepon Wali</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $no => $use)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>
                                                <figure class="avatar mr-2 avatar-xl">
                                                    <img src="{{ asset('Gambar/New Akun/' . $use->foto_profil) }}"
                                                        alt="...">
                                                    @if (Cache::has('user-is-online-' . $use->id))
                                                        <i class="avatar-presence online"></i>
                                                    @else
                                                        <i class="avatar-presence offline"></i>
                                                    @endif

                                                </figure>
                                            </td>
                                            <td>
                                                @if ($use->name != null)
                                                    {{ $use->name }}
                                                @else
                                                    <p class="text-muted"> Belum Dilengkapi </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($use->jenis_kelamin != null)
                                                    @if ($use->jenis_kelamin == 'P')
                                                        Perempuan
                                                    @elseif ($use->jenis_kelamin == 'L')
                                                        Laki - Laki
                                                    @endif
                                                @else
                                                    <p class="text-muted"> Belum Dilengkapi </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($use->no_tlp)
                                                    {{ $use->no_tlp }}
                                                @else
                                                    <p class="text-muted"> Belum Dilengkapi </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($use->no_tlpWali)
                                                    {{ $use->no_tlpWali }}
                                                @else
                                                    <p class="text-muted"> Belum Dilengkapi </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($use->alamat)
                                                    {{ $use->alamat }}
                                                @else
                                                    <p class="text-muted"> Belum Dilengkapi </p>
                                                @endif
                                            </td>
                                            <td>
                                                @if (Cache::has('user-is-online-' . $use->id))
                                                    <li class="text-success">
                                                        Online
                                                    </li>
                                                @else
                                                    <li class="text-muted">
                                                        Offline
                                                    </li>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit_anggota', $use->id) }}"><i
                                                        class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="card-footer">
                    {{-- Footer Card --}}
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
