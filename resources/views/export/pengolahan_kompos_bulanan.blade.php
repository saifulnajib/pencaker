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
                <td colspan="5" style="text-align: center;text-transform:uppercase;">
                    <b>REKAPITULASI DATA PENGOLAHAN BAHAN KOMPOS</b>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;text-transform:uppercase;">
                    <b>UNIT PELAKSANA TEKNIS DAERAH (UPTD) TPA</b>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;text-transform:uppercase;">
                    <b>KOTA TANJUNGPINANG</b>
                </td>
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
                    <th style="background-color:#fcf6bd;border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>TANGGAL</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>BERAT ISI (Kg)</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>KOMPOS KELUAR (Kg)</b>
                    </th>
                    <th style="background-color:#fcf6bd;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="35">
                        <b>KET(TUJUAN)</b>
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #333;">
                @foreach ($items['data'] as $key => $value)
                    @if(count($value['data'])>0)
                        @foreach ($value['data'] as $val)
                            @php
                            $items['jumlah_masuk'] = $items['jumlah_masuk']+$val['berat_masuk'];
                            $items['jumlah_keluar'] = $items['jumlah_keluar']+$val['berat_keluar'];
                            $items['jumlah_isi'] = $items['jumlah_isi']+$val['berat_isi'];
                            $items['jumlah_kompos'] = $items['jumlah_kompos']+$val['kompos_keluar'];
                            @endphp
                            <tr>
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                    height="15" valign="center" align="center">
                                    {{ $key+1 }}
                                </td>

                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ $value['tanggal'] }}
                                </td>

                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{$val['berat_isi']}}
                                </td>

                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{$val['kompos_keluar']}}
                                </td>

                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{$val['keterangan']}}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                height="15" valign="center" align="center">
                                {{ $key+1 }}
                            </td>

                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{ $value['tanggal'] }}
                            </td>

                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                
                            </td>

                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                
                            </td>

                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                
                            </td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="2"style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" valign="center" align="center">
                       <b> JUMLAH </b>
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                       <b> {{$items['jumlah_isi']}}  </b>
                    </td>

                    <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                        valign="center" align="center">
                       <b> {{$items['jumlah_kompos']}}  </b>
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
                <td style="text-align: center;">Mengetahui</td>
                <td></td>
                <td></td>
                <td style="text-align: center;">{{ $items['ttd']['lokasi'] }}, {{ $items['ttd']['waktu'] }}</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">{{ $items['ttd']['jabatan'] }}</td>
                <td></td>
                <td></td>
                <td style="text-align: center;">Pengawas</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td ></td>
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
                <td style="text-align: center;">
                    <b> {{ $items['ttd']['nama_pejabat'] }}</b></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <b>{{ $items['ttd']['nama_pengawas'] }}</b>
                </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center;">
                    <b>NIP {{ $items['ttd']['nip_pejabat'] }}</b></td>
                <td></td>
                <td></td>
                <td style="text-align: center;">
                    <b>NIP {{ $items['ttd']['nip_pengawas'] }}</b>
                </td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </body>

</html>
