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
                    <b>LAPORAN HARIAN PEMUNGUTAN RETRIBUSI SAMPAH</b>
                </td>
            </tr>
            <tr>
                <td colspan="13" style="text-align: center;text-transform:uppercase;">
                    <b>UPTD TPA</b>
                </td>
            </tr>
            <tr>
                <td colspan="13" style="text-align: center;text-transform:uppercase;">
                    <b>KOTA TANJUNGPINANG</b>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="text-align: left;text-transform:uppercase;">HARI/TANGGAL</td>
                <td></td>
                <td style="text-align: left;">{{ $items['time'] }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="text-align: left;text-transform:uppercase;">BULAN</td>
                <td></td>
                <td style="text-align: left;text-transform:uppercase;">{{ $items['bulan'] }}</td>
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
                    <th rowspan="2" style="border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NOPOL KENDARAAN</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NAMA SOPIR</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>JENIS KENDARAAN</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>TIMBUNAN SAMPAH / SUMBER SAMPAH</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>JENIS SAMPAH</b>
                    </th>
                    <th colspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center">
                        <b>JAM</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>BERAT MASUK (Kg)</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>BERAT KELUAR (Kg)</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>VOLUME M3</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>NOMOR KARCIS</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>KET</b>
                    </th>
                </tr>
                <tr>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>MASUK</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>KELUAR</b>
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
                        {{ $value['kendaraan']['sopir'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['kendaraan']['jenisKendaraan']['jenis'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['sumber_sampah'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['jenisSampah']['jenis'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{
                            $carbon::parse($value['waktu_masuk'])->locale('id-ID')->translatedFormat('H:i')
                        }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{
                            $carbon::parse($value['waktu_keluar'])->locale('id-ID')->translatedFormat('H:i')
                        }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['berat_masuk'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['berat_keluar'] }}
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                        {{ $value['volume'] }}
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
            </tbody>
        </table>
        <table>
            <tr>
                <td></td>
                <td>Catatan</td>
            </tr>
            <tr>
                <td style="text-align: center;">1</td>
                <td>Sampah Umum</td>
            </tr>
            <tr>
                <td style="text-align: center;">2</td>
                <td>Sampah Permukiman</td>
            </tr>
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
                <td style="text-align: center;">{{ $items['ttd']['lokasi'] }}, {{ $items['ttd']['waktu'] }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="text-align: center;">Juru Pungut Retribusi UPTD TPA</td>
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
                <td style="text-align: center;">
                    <b>{{ $items['ttd']['juru_pungut'] }}</b>
                </td>
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
                <td style="text-align: center;">
                    <b>NIP {{ $items['ttd']['nip_pejabat'] }}</b>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </body>

</html>
