@inject('carbon', 'Carbon\Carbon')

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            tr td {
                border-bottom: 1px solid #333;
            }
        </style>
    </head>

    <body>
        <table>
            <tr>
                <td colspan="13" style="text-align: center;text-transform:uppercase;">
                    <b>DAFTAR PENYEDOTAN KAKUS RUMAH TANGGA</b>
                </td>
            </tr>
            <tr>
                <td colspan="13" style="text-align: center;text-transform:uppercase;">
                    <b>UPTD TPA KOTA TANJUNGPINANG</b>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="text-align: left;text-transform:uppercase;">BULAN</td>
                <td style="text-align: left;text-transform:uppercase;">{{ $items['bulan'].' '.$items['tahun'] }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-striped" style="border-bottom:1px solid #333;text-align:center;vertical-align:middle"
            width="100%">
            <thead>
                <tr>
                    <th rowspan="2" style="background-color:#fcf6bd;border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NOPOL</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NAMA</b>
                    </th>
                    <th colspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center">
                        <b>KATEGORI</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="40">
                        <b>ALAMAT</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NO TELPON</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>TANGGAL PENYEDOTAN</b>
                    </th>
                    <th colspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center">
                        <b>RETRIBUSI</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>NOMOR KARCIS</b>
                    </th>
                    <th rowspan="2" style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>KET</b>
                    </th>
                </tr>
                <tr>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>RUMAHAN</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>INSTANSI</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>PENYEDOTAN</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>PEMBUANGAN KE IPLT</b>
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #333;">
                @foreach ($items['data'] as $key => $value)
                <tr>
                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" valign="center" align="center">
                        {{ $key+1 }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['kendaraan']['nopol'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['nama'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['id_kategori']=='1' ? 'x':'' }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['id_kategori']=='2' ? 'x':'' }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['alamat'] }} kajdsfk iweuro kjashf8y kjahf
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['nomor_telpon'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $carbon::parse($value['tanggal_penyedotan'])->locale('id-ID')->translatedFormat('d-M-y') }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="right">
                       Rp. {{ $value['retribusi_penyedotan'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="right">
                        Rp. {{ $value['retribusi_pembuangan'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['nomor_karcis'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="8"style="background-color:#80ed99;border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" valign="center" align="center">
                       <b> JUMLAH </b>
                    </td>

                    <td style="background-color:#fcf6bd;border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="right">
                       <b> Rp. {{$items['jumlah_penyedotan']}} </b>
                    </td>

                    <td style="background-color:#fcf6bd;border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="right">
                       <b> Rp. {{$items['jumlah_pembuangan']}} </b>
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                    </td>
                </tr>
                <tr>
                    <td colspan="8"style="background-color:#fcf6bd;border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" valign="center" align="center">
                       <b> TOTAL </b>
                    </td>

                    <td colspan="2" style="background-color:#80ed99;border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="right">
                       <b> Rp. {{$items['jumlah_penyedotan']+$items['jumlah_pembuangan']}} </b>
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">{{ $items['ttd']['lokasi'] }}, {{ $items['ttd']['waktu'] }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">Mengetahui</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">{{ $items['ttd']['jabatan'] }}</td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td >
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <b>{{ $items['ttd']['nama_pejabat'] }}</b>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <b>NIP {{ $items['ttd']['nip_pejabat'] }}</b>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </body>

</html>
