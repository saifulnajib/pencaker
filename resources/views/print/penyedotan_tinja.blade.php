<html>
    <title>Laporan Penyedotan Tinja</title>
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
            .printpreview h4,.printpreview h2,.printpreview h3,.printpreview h5 td{
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
            .center{
                text-align: center;
            }
            .text-end {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="printpreview">
            <!-- <div style="border-top: 3px solid #000;border-bottom: 2px solid #000;padding-top:2px;margin-bottom: 5px;margin-top: 5px"></div> -->
            <br>
            <div class="center">
                <h4><b>
                    DAFTAR PENYEDOTAN KAKUS RUMAH TANGGA <br/>
                    UPTD TPA KOTA TANJUNGPINANG
                </b></h4>
            </div>

            <div class="" style="margin-top:1.5rem; margin-bottom:0.5rem">
                <table class="tablejudul">
                    <tr>
                        <td width="5%">Bulan</td>
                        <td width="1%">:</td>
                        <td>{{date("F ", strtotime("2023-$bulan-01")).$tahun}}</td>
                    </tr>
                </table>
            </div>
                <table class="table">
                    <tr  style="font-weight:200;background-color:#fcf6bd">
                        <td rowspan="2" class="center" style="" width="5%">NO</td>
                        <td rowspan="2" class="center" width="20%">NAMA</td>
                        <td rowspan="2" class="center" width="25%">ALAMAT</td>
                        <td rowspan="2" class="center" width="12%">NOMOR TELP</td>
                        <td rowspan="2" class="center" width="12%">TANGGAL PENYEDOTAN</td>
                        <td colspan="2" class="center" width="18%">RETRIBUSI</td>
                        <td rowspan="2" class="center" width="20%">KETERANGAN</td>
                    </tr>
                    <tr  style="background-color:#fcf6bd">
                        <td class="center" width="1%">PENYEDOTAN</td>
                        <td class="center" width="12%">PEMBUANGAN<br>KE IPLT</td>
                    </tr>
                    <tr class="center" style="background-color:#80ed99">
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td></td>
                        <td>4</td>
                        <td colspan="2">5</td>
                        <td></td>
                    </tr>
                    @foreach($data as $idx=>$val)
                        <tr>
                            <td class="center">{{$idx+1}}</td>
                            <td class="text-start">{{$val->nama}}</td>
                            <td class="text-start">{{$val->alamat}},akdnlka lkjdlajoiu ieuqojlqkj oiuoaj </td>
                            <td class="center">{{$val->nomor_telpon}}</td>
                            <td class="center">{{date('d-M-y',strtotime($val->tanggal_penyedotan))}}</td>
                            <td class="center">Rp. {{$val->retribusi_penyedotan}}</td>
                            <td class="center">Rp. {{$val->retribusi_pembuangan}}</td>
                            <td class="center">{{$val->keterangan}}</td>
                        </tr>
                    @endforeach
                    <tr class="judul center">
                        <td colspan="5" style="background-color:#80ed99">Jumlah</td>
                        <td style="background-color:#fcf6bd">Rp. {{$jumlah_penyedotan}}</td>
                        <td style="background-color:#fcf6bd">Rp. {{$jumlah_pembuangan}}</td>
                        <td></td>
                    </tr>
                    <tr class="judul center">
                        <td colspan="5" style="background-color:#fcf6bd">Total</td>
                        <td colspan="2" style="background-color:#80ed99">Rp. {{$jumlah_penyedotan+$jumlah_pembuangan}}</td>
                        <td></td>
                    </tr>
                </table>

            <div class="ttd" style="margin-top:1rem;">
                <p style="font-size: 10pt;">Tanjungpinang, @carbon(now()) </p>
                <p style="font-size: 10pt;">
                    Mengetahui,<br/>
                    Kepala UPTD TPA
                </p>
                <br />
                <br />
                <br />
                <br />
                <p style="margin:2px 0px;font-size: 10pt"><strong><u>Fulan Bin Fulan</u></strong></p>
                <p style="margin:2px 0px;font-size: 10pt">NIP. 19721207 200805 1 002</p>
            </div>
        </div>
    </body>
</html>
