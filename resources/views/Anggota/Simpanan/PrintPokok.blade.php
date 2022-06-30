<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Print</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    @stack('css')
</head>

<?php
function rupiah($angka)
{
    $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
?>

<body onload="window.print();">
    <div id="app">
        <div class="invoice">
            <div class="invoice-print">
                <div class="main-wrapper">
                    <div class="section-body">
                        {{-- Isi --}}
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="col-md-12">
                                <h1>Simpanan Pokok</h1>
                                {{-- <div class="section-title">Order Summary</div> --}}
                                <p class="section-lead">Semua data simpanan pokok</p>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-md">
                                        <tbody>
                                            <tr>
                                                <th data-width="40" style="width: 40px;">No</th>
                                                <th class="text-center">Anggota</th>
                                                <th class="text-center">Jumlah Setoran</th>
                                                <th class="text-center">Status</th>
                                            </tr>
                                            @foreach ($setoran as $no => $set)
                                                <tr>
                                                    <td>{{ $no + 1 }}</td>
                                                    <td>{{ $set->name }}</td>
                                                    <td>{{ rupiah($set->jumlah_setoran) }}</td>
                                                    <td>
                                                        @if ($set->status == 'Lunas')
                                                            <p class="text-success"> {{ $set->status }}</p>
                                                        @else
                                                            <p class="text-danger">{{ $set->status }}</p>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-12">
                                    <div class="col-lg-12 text-right">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name"></div>
                                            <div class="invoice-detail-value"></div>
                                        </div>
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name"></div>
                                            <div class="invoice-detail-value"></div>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">
                                                @foreach ($total as $tot)
                                                    {{ rupiah($tot->total) }}
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('modal')

            <!-- General JS Scripts -->
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"
                        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
                        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
            <script src="{{ asset('assets/js/stisla.js') }}"></script>

            <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

            <!-- JS Libraies -->
            @stack('top-script')

            <!-- Template JS File -->
            <script src="{{ asset('assets/js/scripts.js') }}"></script>
            <script src="{{ asset('assets/js/custom.js') }}"></script>

            <!-- Page Specific JS File -->
            @stack('page-script')
            @include('sweetalert::alert')
</body>

</html>
