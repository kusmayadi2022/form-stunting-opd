@extends('layout.base')

@section('title', 'Edit Form Dppkb')

@section('main-content')

    <div class="row">
        <div class="col-12 d-flex flex-row align-items-center justify-content-between mb-4">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Edit Dppkb</h1>
        </div>
        @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if (session('error') || session('success'))
            <div class="col-12">
                <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissable fade show" role="alert">
                    {{ session('error') ?? session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/form/Dppkb/update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_report_non_kelurahan" value="{{ $report_non_kelurahan['id'] }}" readonly>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bulan dan Tahun</label>
                            <div class="col-sm-2">
                                <input type="month" class="form-control" name="date" value="{{ $report_non_kelurahan['tahun'] .'-'. substr('0' . $report_non_kelurahan['bulan'], -2) }}">
                            </div>
                        </div>

                        <!-- Nav pills -->
                        <ul class="nav nav-tabs mt-5">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#kesehatan">DATA SASARAN PUS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#bumil3">DATA SASARAN IBU HAMIL 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#bumil4">DATA SASARAN IBU HAMIL 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#kelberesiko4">DATA KELUARGA BERESIKO 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#kelberesiko5">DATA KELUARGA BERESIKO 5</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#okpus3">DATA SASARAN PUS 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#kb1supply">KB 1(Data Supply)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#kb2supply">KB 2(Data Supply)</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="bumil3">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah PUS belum terpenuhi kebutuhan KB</th>
                                                <th>Jumlah PUS Keseluruhan</th>
                                                <th>Persentase PUS tidak terlayani atau tidak ikut program KB</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_PUS_belum_terpenuhi_kebutuhan_KB[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_PUS_belum_terpenuhi_kebutuhan_KB'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_PUS_keseluruhan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_PUS_keseluruhan'] }}">
                                                    </td>
                                                    <td>
                                                        <input  type="number" name="persentase_PUS_tidak_terlayani[]" step="0.01" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['persentase_PUS_tidak_terlayani'] }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kb1supply">
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <div class="card" style="border-top: none; border-top-left-radius: 0;">
                                        <div class="card-body d-flex flex-column individual-question">
                                            <h5><strong>DATA PENDUKUNG INTERVENSI PERCEPATAN PENURUNAN STUNTING</strong></h5>
                                            <span><strong>Indikator:</strong> Tersedia data hasil surveilans keluarga berisiko stunting</span>
                                            <span><strong>Tahun:</strong>Tiap tahun</span>
                                            <span><strong>Target:</strong>2 Kali</span>
                                            <span><strong>Urusan:</strong>Keluarga Berencana</span>
                                            <span>
                                                <strong>Status Tercapai: </strong>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="ya" name="tersedia_data_hasil_surveilans_KBS" @if($report_non_kelurahan['tersedia_data_hasil_surveilans_KBS'] == 'ya') checked @endif>
                                                    <label class="form-check-label">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="tidak" name="tersedia_data_hasil_surveilans_KBS" @if($report_non_kelurahan['tersedia_data_hasil_surveilans_KBS'] == 'tidak') checked @endif>
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </span>
                                            <span>
                                                <strong>Keterangan:</strong>
                                                <textarea name="keterangan_tersedia_data_hasil_surveilans_KBS" class="form-control">{{ $report_non_kelurahan['keterangan_tersedia_data_hasil_surveilans_KBS'] }}</textarea>
                                            </span>
                                        </div>
                                        <div class="card-body d-flex flex-column individual-question">
                                            <span><strong>Indikator:</strong> Tersedia data keluarga bisiko Stunting melalui Sistem Informasi Keluarga</span>
                                            <span><strong>Tahun:</strong>Tiap tahun</span>
                                            <span><strong>Target:</strong>2 Kali</span>
                                            <span><strong>Urusan:</strong>Keluarga Berencana</span>
                                            <span>
                                                <strong>Status Tercapai: </strong>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="ya" name="tersedia_data_KBS_melalui_SI" @if($report_non_kelurahan['tersedia_data_KBS_melalui_SI'] == 'ya') checked @endif>
                                                    <label class="form-check-label">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="tidak" name="tersedia_data_KBS_melalui_SI" @if($report_non_kelurahan['tersedia_data_KBS_melalui_SI'] == 'tidak') checked @endif>
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </span>
                                            <span>
                                                <strong>Keterangan:</strong>
                                                <textarea name="keterangan_tersedia_data_KBS_melalui_SI" class="form-control">{{ $report_non_kelurahan['keterangan_tersedia_data_KBS_melalui_SI'] }}</textarea>
                                            </span>
                                        </div>
                                        <div class="card-body d-flex flex-column individual-question">
                                            <span><strong>Indikator:</strong> Persentase Kabupaten/kota yang menerima pendampingan percepatan penurunan stunting melalui Tri Dharma Perguruan tinggi</span>
                                            <span><strong>Tahun:</strong>2024</span>
                                            <span><strong>Target:</strong>1 Kerjasama</span>
                                            <span><strong>Urusan:</strong>Keluarga Berencana</span>
                                            <span>
                                                <strong>Status Tercapai: </strong>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="ya" name="persentase_terima_pendamping_penurunan_stunting" @if($report_non_kelurahan['persentase_terima_pendamping_penurunan_stunting'] == 'ya') checked @endif>
                                                    <label class="form-check-label">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="tidak" name="persentase_terima_pendamping_penurunan_stunting" @if($report_non_kelurahan['persentase_terima_pendamping_penurunan_stunting'] == 'tidak') checked @endif>
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </span>
                                            <span>
                                                <strong>Keterangan:</strong>
                                                <textarea name="ket_persentase_terima_pendamping_penurunan_stunting" class="form-control">{{ $report_non_kelurahan['ket_persentase_terima_pendamping_penurunan_stunting'] }}</textarea>
                                            </span>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bumil4">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah Kehamilan Tidak Diinginkan(KTD)</th>
                                                <th>Jumlah Ibu Hamil</th>
                                                <th>Persentase (KTD) atau kehamilan yang belum direncanakan pada saat itu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_kehamilan_tidak_diinginkan_KTD[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_kehamilan_tidak_diinginkan_KTD'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_ibu_hamil[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_ibu_hamil'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="persentase_KTD_kehamilan_belum_direncanakan[]" step="0.01" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['persentase_KTD_kehamilan_belum_direncanakan'] }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane active" id="kesehatan">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah keluarga</th>
                                                <th>Jumlah Keluarga Beresiko Stunting</th>
                                                <th>Persentase</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah_keluarga[]" class="form-control"  value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jumlah_keluarga'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah_keluarga_beresiko_stunting[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jumlah_keluarga_beresiko_stunting'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="persentase[]" class="form-control" step="0.01" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['persentase'] }}">
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>    
                            

                            <div class="tab-pane fade" id="kelberesiko4">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah ibu pasca bersalin yang mendapat pelayanan</th>
                                                <th>Jumlah seluruh ibu pasca persalinan</th>
                                                <th>Persentase layanan KB terhadap seluruh ibu melahirkan dalam kurun waktu yang sama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="Jml_ibu_pasca_bersalin_mendapat_pelayanan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jml_ibu_pasca_bersalin_mendapat_pelayanan'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_ibu_pasca_persalinan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_seluruh_ibu_pasca_persalinan'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="persentase_layanan_KB_kurun_waktu_sama[]" step="0.01" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['persentase_layanan_KB_kurun_waktu_sama'] }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="kelberesiko5">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah keluarga berisiko stunting yang memperoleh pendampingan dari tim pendekatan keluarga </th>
                                                <th>Jumlah seluruh keluarga berisiko</th>
                                                <th>Persentase layanan pendampingan terhadap seluruh keluarga berisiko stunting dalam kurun waktu yang sama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_keluarga_berisiko_stunting_memperoleh_pendampingan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_keluarga_berisiko_stunting_memperoleh_pendampingan'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_keluarga_berisiko[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_seluruh_keluarga_berisiko'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="persentase_layanan_pendampingan_keluagra_berisiko[]" step="0.01" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['persentase_layanan_pendampingan_keluagra_berisiko'] }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="okpus3">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Calon PUS memperoleh pendampingan kesehatan reproduksi 3 bulan pra nikah </th>
                                                <th>Jumlah PUS yang mendaftarkan pernikahan </th>
                                                <th>Calon PUS memperoleh pendampingan kesehatan reproduksi 3bulan pra nikah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="calon_PUS_memperoleh_pendampingan_kesehatan_reproduksi[]" class="form-control"  value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['calon_PUS_memperoleh_pendampingan_kesehatan_reproduksi'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_PUS_mendaftarkan_pernikahan[]" class="form-control"  value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['jml_PUS_mendaftarkan_pernikahan'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="cln_PUS_memperoleh_pendampingan_kesehatan_reproduksi[]" step="0.01" class="form-control"  value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['cln_PUS_memperoleh_pendampingan_kesehatan_reproduksi'] }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="kb2supply">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>                               
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Pusat Informasi dan Konseling (PIK) Remaja & Bina Keluarga Remaja (BKR) yang melaksanakan edukasi kesehatan reproduksi dan gizi bagi remaja</th>
                                                <th>Desa/Kelurahan yang melaksanakan kelas Bina Keluarga Balita (BKB) tentang pengasuhan 1000 HPK</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                        <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="PIK_dan_BKR_edukasi[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['PIK_dan_BKR_edukasi'] }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="kelurahan_melaksanakan_BKB[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['kelurahan_melaksanakan_BKB'] }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <button class="btn btn-outline-success mt-3 float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection