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
                <td colspan="7" style="text-align: center;text-transform:uppercase;">
                    <b>RIWAYAT KGB DINAS LINGKUNGAN HIDUP</b>
                </td>
            </tr>
            <tr>
                <td colspan="7" style="text-align: center;text-transform:uppercase;">
                    <b>KOTA TANJUNGPINANG</b>
                </td>
            </tr>
        </table>
        <table class="table table-striped" style="border-bottom:1px solid #333;text-align:center;vertical-align:middle"
            width="100%">
            <thead>
                <tr>
                    <th style="border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="left" valign="center" width="30">
                        <b>NAMA</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>NIP</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>NO. KGB</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>TANGGAL KGB</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>TANGGAL BERAKHIR KGB</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="30">
                        <b>KETERANGAN</b>
                    </th>
                </tr>
            </thead>
            <tbody style="border-bottom:1px solid #333;">
                @foreach ($items['data'] as $key => $value)
                <tr>
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" valign="center" align="center">
                        {{ $key+1 }}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="left">
                        {{ $value['dataPegawai']['nama']}}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                       '{{ $value['dataPegawai']['nip'] }}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{$value['no_kgb']}}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $carbon::parse($value['tanggal_kgb'])->locale('id-ID')->translatedFormat('d-m-Y') }}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $carbon::parse($value['tanggal_berakhir_kgb'])->locale('id-ID')->translatedFormat('d-m-Y') }}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="left">
                        {{ $value['keterangan'] }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
