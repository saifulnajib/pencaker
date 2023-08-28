<style type="text/css">
.page_break {
    page-break-before: always;
}
.printpreview tr th {
  font-size: 9pt;
  font-weight: bold;
  font-family: "Cambria",sans-serif;
  padding: 4px;
  text-transform: uppercase;
}
.printpreview tr td {
  font-size: 9pt;
  font-family: "Cambria",sans-serif;
  vertical-align: middle;
  padding: 4px;
}

.printpreview h4,.printpreview h2,.printpreview h3,.printpreview h5{
  text-align: center;
  font-family: "Cambria",sans-serif;
  font-weight: 300;
}

.printpreview table{
  width: 100%;
  border-collapse: collapse;
}
.printpreview table.table, .printpreview table.table th, .printpreview table.table td {
    border: 0.5px solid #333;
}

@page
{
  margin:1cm 1cm 1cm 1cm;
}

.printpreview table.tablejudul tr td {
    font-size: 11pt;
}

.printpreview table.tablejudul tr td {
    padding: 2px !important;
}

.printpreview{
    font-size: 9.5pt;
}

.center {
    text-align: center;
    align-items: center;
}

img {
    display: inline-block;
    vertical-align: middle;
    max-width: 28%;
    height: auto;
    margin: 0 20px 10px 20px;
}
.ttd {
  position: absolute;
  float: right;
  width: 320px;
  /* padding: 10px; */
  margin: 0;
}

</style>
@foreach ($kendaraan as $dt)
@php
$i=1;
$jumlah_masuk=0;
$jumlah_keluar=0;
$jumlah_kompos=0;
@endphp
    <div class="printpreview">
    <br/>
    <h3 style="margin:1px 0px;font-size: 11pt"><strong>REKAPITULASI DATA PENGOLAHAN BAHAN KOMPOS</strong></h3>
    <h3 style="margin:1px 0px;font-size: 11pt"><strong>UNIT PELAKSANA TEKNIS DINAS (UPTD) TPA</strong></h3>
    <h3 style="margin:1px 0px;font-size: 11pt"><strong>KOTA TANJUNGPINANG</strong></h3><br>

    <table class="tablejudul">
        <tr>
            <td width="5%">Bulan</td>
            <td width="1%">:</td>
            <td>{{date("F ", strtotime("2023-$bulan-01")).$tahun}}</td>
        </tr>
    </table>
    
    <!-- <div style="border-top: 3px solid #000;border-bottom: 2px solid #000;padding-top:2px;margin-bottom: 5px;margin-top: 5px"></div>  -->
    <br />
    <table class="table">
    <thead>
        <tr style="background-color:#a8dadc">
        <th rowspan="2" width="3%"><strong>No</strong></th>
        <th rowspan="2" width="15%"><strong>Tanggal</strong></th>
        <th rowspan="2" width="15%"><strong>Nopol</br>Kendaraan</strong></th>
        <th colspan="2" width="8%"><strong>Jam</strong></th>
        <th colspan="3" width="15%"><strong>Berat (Kg)</strong></th>
        <th rowspan="2" width="8%"><strong>Kompos</br>Keluar</br>(Kg)</strong></th>
        <th rowspan="2" width="20%"><strong>Keterangan</strong></th>
        </tr>
        <tr style="background-color:#a8dadc">
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Masuk</th>
            <th>Keluar</th>
            <th>Isi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $val)
            @if($dt->id == $val->id_kendaraan)
                <tr >
                    <td class="center">{{$i}}</td>
                    <td class="center">{{date('d/m/Y', strtotime($val->waktu_masuk))}}</td>
                    <td class="center">{{$val->kendaraan->nopol}}</td>
                    <td class="center">{{date('h:m', strtotime($val->waktu_masuk))}}</td>
                    <td class="center">{{date('h:m', strtotime($val->waktu_keluar))}}</td>
                    <td class="center">{{$val->berat_masuk}}</td>
                    <td class="center">{{$val->berat_keluar}}</td>
                    <td class="center">{{$val->berat_isi}}</td>
                    <td class="center">{{$val->kompos_keluar}}</td>
                    <td>{{$val->keterangan}}</td>
                </tr>
                @php
                    $i++;
                    $jumlah_masuk = $jumlah_masuk+$val->berat_masuk;
                    $jumlah_keluar = $jumlah_keluar+$val->berat_keluar;
                    $jumlah_kompos = $jumlah_kompos+$val->kompos_keluar;
                @endphp
            @endif
        @endforeach
            <tr style="background-color:#a8dadc">
                <td colspan="5" class="center"><strong>Jumlah</strong></td>
                <td class="center"><strong>{{$jumlah_masuk}}</strong></td>
                <td class="center"><strong>{{$jumlah_keluar}}</strong></td>
                <td class="center"><strong>{{$jumlah_masuk-$jumlah_keluar}}</strong></td>
                <td class="center"><strong>{{$jumlah_kompos}}</strong></td>
                <td class="center"><strong></strong></td>
            </tr>
    </tbody>        
    </table><br>
    <div class="ttd" ">
        <p style="margin:2px 0px;font-size: 11pt;">Tanjungpinang, @carbon(now()) </p>
        <p style="margin:2px 0px;font-size: 11pt;">
            Pengawas
        </p>
        <br />
        <br />
        <br />
        <br />
        <p style="margin:2px 0px;font-size: 11pt"><strong><u>Fulan Bin Fulan</u></strong></p>
        <p style="margin:2px 0px;font-size: 11pt">NIP. 19721207 200805 1 002</p>
    </div>

    <div class="ttd">
        <p style="margin:2px 0px;font-size: 11pt">Mengetahui,</p>
        <p style="margin:2px 0px;font-size: 11pt">Kepala UPTD TPA</p>
        <br />
        <br />
        <br />
        <br />
        <p style="margin:2px 0px;font-size: 11pt"><strong><u>Fulan bin Fulan</u></strong></p>
        <p style="margin:2px 0px;font-size: 11pt">NIP. 19760320 200604 1 017</p>
    </div>
    <div class="page_break"></div>
@endforeach
