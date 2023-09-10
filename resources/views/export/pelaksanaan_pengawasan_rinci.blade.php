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
        <table class="table table-striped" style="border-bottom:1px solid #333;text-align:center;vertical-align:middle"
            width="100%">
            <thead>
                <tr>
                    <th style="background-color:#c9ada7;border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="40">
                        <b>Nama Usaha / Jenis Kegiatan / Alamat</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>Dokumen LH</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>Pelaksanaan Pengawasan</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>Temuan Pengawasan</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="40">
                        <b>Surat Tindaklanjut Pengawasan</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>Rekomendasi Hasil Pengawasan</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>Batas Waktu Tindaklanjut</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>Tindaklanjut Usaha dan / atau Kegiatan</b>
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #333;">
                @foreach ($items['data'] as $key => $value)
                    @if($loop->first) 
                        @php $sektor = '1'; @endphp
                    @endif
                        @if($value['kegiatanUsaha']['sektorKegiatan']['sektor'] != $sektor)
                            <tr>
                                <td style="background-color:#4f772d;border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                colspan="9"><b>{{$value['kegiatanUsaha']['sektorKegiatan']['sektor'] }}</b></td>
                            </tr>
                        @endif
                        <tr>
                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                height="30" valign="center" align="center">
                                {{ $key+1 }}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{ $value['kegiatanUsaha']['nama_usaha'] }}/{{$value['kegiatanUsaha']['sektorKegiatan']['sektor']}}/{{$value['kegiatanUsaha']['alamat']}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['kegiatanUsaha']['dokumen_lh']}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{$carbon::parse($value['tanggal_pengawasan'])->locale('id-ID')->translatedFormat('d/m/y')}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" >
                                {{$value['temuan_pengawasan']}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['surat_tindaklanjut']}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['rekomendasi_hasil_pengawasan']}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{$carbon::parse($value['batas_waktu_tindaklanjut'])->locale('id-ID')->translatedFormat('d/m/y')}}
                            </td>

                            <td style="{{$loop->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['tindaklanjut_usaha']}}
                            </td>
                        </tr>
                    @php $sektor = $value['kegiatanUsaha']['sektorKegiatan']['sektor']; @endphp
                @endforeach
            </tbody>
        </table>
    </body>

</html>
