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
                <td colspan="9" style="text-align: center;text-transform:uppercase;">
                    <b>DATA BANK SAMPAH DINAS LINGKUNGAN HIDUP</b>
                </td>
            </tr>
            <tr>
                <td colspan="9" style="text-align: center;text-transform:uppercase;">
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
                        <b>NAMA</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>ALAMAT</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="25">
                        <b>KODE WILAYAH</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>STATUS PENGAJUAN</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>NOMOR TELPON</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>LATITUDE</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>LONGITUDE</b>
                    </th>
                    <th style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="20">
                        <b>STATUS</b>
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
                        {{ $value['nama'] }}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="left">
                        {{ $value['alamat'] }}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['kode_wilayah']}}
                    </td>
                    
                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['status_pengajuan'] }}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['nomor_telpon'] }}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['latitude'] }}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['longitude'] }}
                    </td>

                    <td  style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        valign="center" align="center">
                        {{ $value['is_active']==1 ? 'AKTIF' : 'NON-AKTIF' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>

</html>
