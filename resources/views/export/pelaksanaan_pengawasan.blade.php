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
                        <b>Nama Kegiatan Usaha / Penanggungjawab</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>Jenis Kegiatan</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>Alamat</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>Dokumen Lingkungan Hidup</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="40">
                        <b>Pelaksanaan Pengawasan</b>
                    </th>
                    <th style="background-color:#c9ada7;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>Keterangan</b>
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #333;">
                @foreach ($items['data'] as $key => $value)
                    @foreach($value->pelaksanaanPengawasan as $val)
                        <tr>
                            @if($loop->first)
                            <td rowspan="{{count($value->pelaksanaanPengawasan)}}" style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                height="15" valign="center" align="center">
                                {{ $key+1 }}
                            </td>

                            <td rowspan="{{count($value->pelaksanaanPengawasan)}}" style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{ $value['nama_usaha'] }} / {{$value['nama_penanggungjawab']}}
                            </td>

                            <td rowspan="{{count($value->pelaksanaanPengawasan)}}" style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['sektorKegiatan']['sektor']}}
                            </td>

                            <td rowspan="{{count($value->pelaksanaanPengawasan)}}" style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['alamat']}}
                            </td>

                            <td rowspan="{{count($value->pelaksanaanPengawasan)}}" style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$value['dokumen_lh']}}
                            </td>
                            @endif
                            <td style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{$carbon::parse($val['tanggal_pengawasan'])->locale('id-ID')->translatedFormat('d/m/y')}}
                            </td>

                            <td style="{{$loop->parent->odd?'background-color:#ffc8dd':'background-color:#bde0fe'}};border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center">
                                {{$val['temuan_pengawasan']}}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </body>

</html>
