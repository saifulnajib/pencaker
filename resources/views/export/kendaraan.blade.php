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
                    <b>DATA KENDARAAN DINAS LINGKUNGAN HIDUP</b>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: center;text-transform:uppercase;">
                    <b>KOTA TANJUNGPINANG</b>
                </td>
            </tr>
            <tr>
                <td></td>
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
                        align="center" valign="center" width="25">
                        <b>NOMOR POLISI</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>SOPIR</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>JENIS KENDARAAN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>RUTE</b>
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
                        valign="center" align="center">
                        {{ $value['nopol'] }}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['sopir'] }}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['jenisKendaraan']['jenis']}}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['ruteKendaraan']['rute'] }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
