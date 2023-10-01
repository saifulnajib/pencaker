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
                <td>
                </td>
            </tr>
            <tr>
                <td colspan="11" style="text-align: center;text-transform:uppercase;">
                    <b>PENGELOLAAN B3 DAN LIMBAH B3</b>
                </td>
            </tr>
        </table>
        <table class="table table-striped" style="border-bottom:1px solid #333;text-align:center;vertical-align:middle"
            width="100%">
            <thead>
                <tr>
                    <th style="border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="30" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th  style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="40">
                        <b>NAMA USAHA DAN/ATAU KEGIATAN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>NAMA PERUSAHAAN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>ALAMAT</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>NAMA PENANGGUNG JAWAB USAHA DAN/ATAU KEGIATAN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>JENIS LIMBAH</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>KODE LIMBAH</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>PERIZINAN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NOMOR</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>TAHUN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>KETERANGAN</b>
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #333;">
                @foreach ($items['data'] as $key => $value)
                    @foreach($value['pengelolaanLimbah'] as $val)
                        <tr>
                        @if($loop->first)
                            <td rowspan="{{count($value['pengelolaanLimbah'])}}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                height="15" valign="center" align="center">
                                {{ $key+1 }}
                            </td>
                            
                            <td rowspan="{{count($value['pengelolaanLimbah'])}}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{$value['sektorKegiatan']['sektor'] }}
                            </td>

                            <td rowspan="{{count($value['pengelolaanLimbah'])}}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{ $value['nama_usaha'] }}
                            </td>
                            
                            <td rowspan="{{count($value['pengelolaanLimbah'])}}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{ $value['alamat'] }}
                            </td>
                            
                            <td rowspan="{{count($value['pengelolaanLimbah'])}}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{ $value['nama_penanggungjawab'] }}
                            </td>
                        @endif
                            <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{ $val['jenis_limbah'] }}
                            </td>
                            
                            <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{ $val['kode_limbah'] }}
                            </td>
                            
                            <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $val['perizinan'] }}
                            </td>
                            
                            <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $val['nomor'] }}
                            </td>
                            
                            <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $val['tahun'] }}
                            </td>
                            
                            <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="left">
                                {{ $val['keterangan'] }}
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </body>

</html>
