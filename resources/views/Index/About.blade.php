@extends('Index.LayoutAwal.Master')

@section('title', 'About')
@section('judul', 'About')

@push('css')
@endpush

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <img src="{{ asset('assets/img/unsplash/koperasi.jpg') }}" style="width: 100%" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>About Koperasi IT Del</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse1" class="btn btn-icon btn-info" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse1" style="">
                        <div class="card-body">
                            <p>
                                Koperasi Serba Usaha Politeknik Informatika Del (KSU PI Del) berdiri sejak 7 April 2004 yang
                                disyahkan
                                berdasarkan badan hukum dengan Nomor Badan Hukum 49.A/BH/KUKM-TS/2004. KSU PI Del melakukan
                                kegiatannya
                                berdasarkan prinsip-prinsip koperasi diantaranya keanggotaannya bersifat sukarela dan
                                terbuka. Dimana
                                maksud sukarela adalah setiap anggota koperasi mendaftar menjadi anggota atas kemauan
                                sendiri, dan dapat
                                mengajukan pengunduran diri jika merasa kurang memperoleh manfaat dari usaha koperasi atau
                                karena alasan
                                lain seperti berhenti dari tempat kerja dan lain sebagainya. Sedangkan maksud terbuka adalah
                                menerima
                                anggota secara terbuka bagi siapa saja yang berminat menjadi anggota, tidak bersifat memaksa
                                dengan tidak
                                mewajibkan untuk mendaftarkan diri sebagai anggota.
                            </p>
                            <p>
                                Keanggotaan koperasi bersifat sukarela dan terbuka, tidak berarti siapapun dapat masuk
                                menjadi anggota.
                                Terdapat syarat-syarat yang harus dipenuhi diantaranya bersedia melakukan segala kewajiban
                                yang diatur
                                dalam Anggaran Dasar dan Anggaran Rumah Tangga. Syarat lainnya yang paling utama adalah
                                anggota koperasi
                                merupakan Pegawai di Yayasan Del Cabang Sumut, Institut Teknologi Del dan SMA Unggul Del.
                            </p>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Bidang Usaha</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse2" class="btn btn-icon btn-info" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse2" style="">
                        <div class="card-body">
                            <p>
                                Usaha yang diselenggarakan KSU PI Del adalah mengadakan usaha simpan pinjam dan pengembangan
                                usaha di sektor pertokoan.

                            <ul>
                                <li>
                                    Unit Toko Toko <br>
                                    Unit Toko menjual beberapa kebutuhan seperti makanan & minuman ringan, alat mandi, alat
                                    tulis dan lainnya. Unit toko berada di kontainer Lapangan Napitupulu.
                                </li>
                                <li>
                                    Usaha Simpan Pinjam <br>
                                    Menjalankan usaha simpan pinjam bagi anggota. Usaha ini dilakukan untuk membantu anggota
                                    yang membutuhkan dana baik untuk tujuan keluarga, usaha dan lainnya
                                </li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengurus dan Pengawas</h4>
                        <div class="card-header-action">
                            <a data-collapse="#mycard-collapse3" class="btn btn-icon btn-info" href="#"><i
                                    class="fas fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse3" style="">
                        <div class="card-body">
                            <p>
                                Pengurus koperasi dipilih dari kalangan dan oleh anggota dalam suatu rapat anggota. Pengurus
                                adalah perangkat organisasi Koperasi yang melakukan pengelolaan Koperasi untuk kepentingan
                                dan tujuan Koperasi, serta mewakili Koperasi secara formal. Pengurus diangkat oleh Rapat
                                Anggota untuk masa jabatan 5 (lima) tahun dan sesudahnya dapat dipilih kembali.
                                <br>
                                Pengurus KSU PI Del periode Desember 2021 s/d 2026 berjumlah 3 orang yaitu:
                            <ul>
                                <li>Ketua : Indra Hartarto Tambunan, Ph.D.</li>
                                <li>Sekretaris : I Gde Eka Dirgayussa, S.Pd,M.Si</li>
                                <li>Bendahara : Indra Sarito Lumbantobing, S.Pd</li>
                            </ul>

                            Sedangkan Pengawas KSU PI Del berjumlah 3 orang yaitu:
                            <ul>
                                <li>Ketua : Dr. Arlinta Christy Barus, ST., M.InfoTech.</li>
                                <li>Ketua II : Fidelis Haposan Silalahi, S.H., M.H</li>
                                <li>Sekretaris : Dohar Manik</li>
                            </ul>

                            </p>
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
