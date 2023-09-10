<html>
    <title>Cetak Surat Rekomendasi</title>
    <head>
        <style type="text/css">
            .page_break {
                page-break-before: always;
            }
            .printpreview tr th {
                font-size: 10pt;
                font-weight: bold;
                font-family: "Arial",sans-serif;
                padding: 4px;
                text-transform: uppercase;
            }
            .printpreview tr td {
                font-size: 10pt;
                font-family: "Arial",sans-serif;
                vertical-align: top;
                padding: 4px;
            }
            .kop {
                font-family: "Arial",sans-serif ;
            }
            .printpreview h4,.printpreview h2,.printpreview h3,.printpreview h5{
                text-align: center;
                font-family: "Arial",sans-serif;
                font-weight: 300;
            }
            .printpreview table{
                width: 100%;
                border-collapse: collapse;
            }
            .printpreview table.table, .printpreview table.table th, .printpreview table.table td {
                border: 0.5px solid #333;
            }
            @page {
                margin:1cm 2cm 1cm 2.54cm;
            }
            .printpreview table.tablejudul tr td {
                font-size: 10pt;
            }
            .printpreview table.tablejudul tr td {
                padding: 2px !important;
            }
            .printpreview{
                font-size: 9.5pt;
            }
            .ttd {
                position: absolute;
                float: right;
                width: 320px;
                /* padding: 10px; */
                font-family: "Arial",sans-serif;
                text-align: center;
                margin: 0;
            }
            .printpreview table.tablein tr td {
                font-size: 9pt;
            }
            .text-start {
                text-align: left;
            }
            .center {
                text-align: center;
            }
            .text-end {
                text-align: right;
            }
            .judul {
                font-weight: 200;
            }
        </style>
    </head>
    <body>
        <div class="printpreview">
            <!-- <div style="border-top: 3px solid #000;border-bottom: 2px solid #000;padding-top:2px;margin-bottom: 5px;margin-top: 5px"></div> -->
            <br>
            <div class="center">
                <h3><b>DATA SAMPAH MASUK HARIAN {{$tanggal}}</b></h3>
                <h3><b>UPTD TPA</b></h3>
                <h3><b>KOTA TANJUNGPINANG</b></h3>
            </div>

            <div class="" style="margin-top:1.5rem; margin-bottom:1.5rem">
                <table class="tablejudul">
                    <tr>
                        <td width="10%">TANGGAL</td>
                        <td width="1%">:</td>
                        <td>{{date('d F Y', strtotime($tanggal))}}</td>
                    </tr>
                    <tr>
                        <td width="10%">Bulan</td>
                        <td width="1%">:</td>
                        <td>{{date('F', strtotime($tanggal))}}</td>
                    </tr>
                </table>
            </div>
                <table class="table">
                    <tr class="judul">
                        <td class="center" width="5%">NO</td>
                        <td class="center" width="30%">KENDARAAN</td>
                        <td class="center" width="15%">NO. BAK</td>
                        <td class="center" width="12%">NO. KARCIS</td>
                        <td class="center" width="12%">TARIF</td>
                        <td class="center" width="18%">MASUK</td>
                        <td class="center" width="20%">KELUAR</td>
                        <td class="center" width="20%">BERAT SAMPAH</td>
                        <td class="center" width="20%">SUMBER</td>
                    </tr>
                    @foreach($sampah as $idx=>$val)
                        <tr>
                            <td class="center">{{$idx+1}}</td>
                            <td class="center">{{$val->kendaraan->nopol}}</td>
                            <td class="center">{{$val->nomor_bak}}</td>
                            <td class="center">{{$val->nomor_karcis}}</td>
                            <td class="center">{{$val->tarif_retribusi}}<br/>({{$val->jenis_retribusi}})</td>
                            <td class="center">{{$val->waktu_masuk}}<br/>({{$val->berat_masuk}})</td>
                            <td class="center">{{$val->waktu_keluar}}<br/>({{$val->berat_keluar}})</td>
                            <td class="center">{{$val->berat_sampah}}</td>
                            <td class="center">{{$val->sumber_sampah}}</td>
                        </tr>
                    @endforeach
                </table>

            <div class="ttd" style="margin-top:1rem;">
                <p style="font-size: 10pt;">Tanjungpinang, {{date('d F Y', strtotime($tanggal))}}</p>
                <p style="margin:5px 0px;font-size: 10pt;">
                    KEPALA UPTD TPA GANET<br/>
                    DINAS LINGKUNGAN HIDUP<br/>
                    KOTA TANJUNGPINANG
                </p>
                <br />
                <br />
                <br />
                <br />
                <p style="margin:2px 0px;font-size: 10pt"><strong><u>Fulan Bin Fulan</u></strong></p>
                <p style="margin:2px 0px;font-size: 10pt">Penata Tk. I</p>
                <p style="margin:2px 0px;font-size: 10pt">NIP. 19721207 200805 1 002</p>
            </div>
        </div>
    </body>
</html>
