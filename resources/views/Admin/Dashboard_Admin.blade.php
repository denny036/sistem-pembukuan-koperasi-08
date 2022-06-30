@section('title', 'Dashboad - Admin')
@section('judul', 'Dashboad - Admin')

<?php
function rupiah($angka)
{
    $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<div class="row">

    <div class="col-12 col-md-6 col-lg-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i style="font-size: 20px; color: #ffff" class="fa-solid fa-money-bills"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Saldo Pokok</h4>
                        </div>
                        <div class="card-body">
                            @if (!array_filter((array) $totalPokok))
                                Empty
                            @else
                                @foreach ($totalPokok as $tot)
                                    {{ rupiah($tot->total) }}
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i style="font-size: 20px; color: #ffff" class="fa-solid fa-money-bills"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Saldo Wajib</h4>
                        </div>
                        <div class="card-body">
                            @if (!array_filter((array) $totalWajib))
                                Empty
                            @else
                                @foreach ($totalWajib as $tot)
                                    {{ rupiah($tot->total) }}
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i style="font-size: 20px; color: #ffff" class="fa-solid fa-money-bills"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Saldo Sukarela</h4>
                        </div>
                        <div class="card-body">
                            @if (!array_filter((array) $totalSukarela))
                                Empty
                            @else
                                @foreach ($totalSukarela as $tot)
                                    {{ rupiah($tot->total) }}
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i style="font-size: 20px; color: #ffff" class="fa-solid fa-money-bills"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pinjaman Belum Lunas</h4>
                        </div>
                        <div class="card-body">
                            @foreach ($totalPinjaman as $tot)
                                @if (!array_filter((array) $totalBayar))
                                    {{ rupiah($tot->total) }}
                                @else
                                    @foreach ($totalBayar as $totbay)
                                        {{ rupiah($tot->total - $totbay->total) }}
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Notifications</h4>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header collapsed" role="button" data-toggle="collapse"
                                data-target="#panel-body-1" aria-expanded="false">
                                <h4>Pinjaman</h4>
                            </div>
                            <div class="accordion-body collapse" id="panel-body-1" data-parent="#accordion"
                                style="">
                                <ul class="list-unstyled">
                                    @foreach ($utang as $u)
                                        @if (Auth::user()->role == 'admin')
                                            @if ($u->tgl_pelunasan < $date && $u->status != 'Lunas')
                                                <li class="media">
                                                    <div style="font-size : 15px; color : rgb(230, 35, 39)">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                    </div>&nbsp &nbsp
                                                    <div class="media-body">
                                                        <p>Pinjaman {{ $u->name }} pada
                                                            {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} dan
                                                            berahir pada
                                                            {{ date('d F Y', strtotime($u->tgl_pelunasan)) }} sudah
                                                            jatuh tempo
                                                        </p>
                                                    </div>
                                                </li>
                                            @elseif ($u->tgl_pelunasan > $date && $u->status != 'Lunas')
                                                <li class="media">
                                                    <div style="font-size : 15px; color : rgb(47, 191, 232)">
                                                        <i class="fa-solid fa-bullhorn"></i>
                                                    </div>&nbsp &nbsp
                                                    <div class="media-body">
                                                        <p>{{ $u->name }} memiliki pinjaman pada
                                                            {{ date('d F Y', strtotime($u->tgl_pinjaman)) }}
                                                            dan jatuh
                                                            tempo pada
                                                            {{ date('d F Y', strtotime($u->tgl_pelunasan)) }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="media">
                                                    <div style="font-size : 15px; color : rgb(37, 208, 37)">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                    </div>&nbsp &nbsp
                                                    <div class="media-body">
                                                        <p>Pinjaman {{ $u->name }} pada
                                                            {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} sudah
                                                            Lunas
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                        @else
                                            @if ($u->tgl_pelunasan < $date && $u->status != 'Lunas')
                                                <li class="media">
                                                    <div style="font-size : 15px; color : rgb(230, 35, 39)">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                    </div>&nbsp &nbsp
                                                    <div class="media-body">
                                                        <p>Pinjaman anda pada
                                                            {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} sudah
                                                            jatuh
                                                            tempo
                                                        </p>
                                                    </div>
                                                </li>
                                            @elseif ($u->tgl_pelunasan > $date && $u->status != 'Lunas')
                                                <li class="media">
                                                    <div style="font-size : 15px; color : rgb(47, 191, 232)">
                                                        <i class="fa-solid fa-bullhorn"></i>
                                                    </div>&nbsp &nbsp
                                                    <div class="media-body">
                                                        <p>Anda memiliki pinjaman pada
                                                            {{ date('d F Y', strtotime($u->tgl_pinjaman)) }}
                                                            dan jatuh
                                                            tempo pada
                                                            {{ date('d F Y', strtotime($u->tgl_pelunasan)) }}
                                                        </p>
                                                    </div>
                                                </li>
                                            @else
                                                <li class="media">
                                                    <div style="font-size : 15px; color : rgb(37, 208, 37)">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                    </div>&nbsp &nbsp
                                                    <div class="media-body">
                                                        <p>Pinjaman anda pada
                                                            {{ date('d F Y', strtotime($u->tgl_pinjaman)) }} sudah
                                                            Lunas
                                                        </p>
                                                    </div>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@error('kategori')
    <div class="col-12 col-md-12 col-lg-12">
        <div class="alert alert-info alert-has-icon alert-dismissible show fade">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <div class="alert-title">Info</div>
                Pinjaman anda sudah jatuh tempo
            </div>
        </div>
    </div>
@enderror
