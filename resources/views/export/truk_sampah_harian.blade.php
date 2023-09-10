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
                <td colspan="14" style="text-align: center;text-transform:uppercase;">
                    <b>DATA HARIAN TRUK SAMPAH KENDARAAN DINAS MASUK KE UPTD TPA</b>
                </td>
            </tr>
            <tr>
                <td colspan="14" style="text-align: center;text-transform:uppercase;">
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
                <td></td>
                <td></td>
                <td></td>
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
                <td></td>
                <td></td>
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
                    <th rowspan="2" style="border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NO</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="18">
                        <b>NAMA SOPIR</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="18">
                        <b>NOPOL KENDARAAN</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="18">
                        <b>JENIS KENDARAAN</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="35">
                        <b>RUTE</b>
                    </th>
                    <th rowspan="2" style="border-left: 1px solid #333;border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        height="15" align="center" valign="center" width="10">
                        <b>NOMOR BAK</b>
                    </th>
                    <th colspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center">
                        <b>JAM</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>JUMLAH TRIP</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>BERAT MASUK</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>BERAT KELUAR</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>BERAT SAMPAH</b>
                    </th>
                    <th rowspan="2" style="border-top:1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                        align="center" valign="center" width="10">
                        <b>VOLUME M3</b>
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
                    @if(count($value->sampahMasuk) > 0)
                        @php $firstSampah = true; @endphp
                        @foreach($value->sampahMasuk as $sampah)
                            <tr>
                                @if($firstSampah)
                                    <td rowspan="{{ count($value->sampahMasuk) + 1 }}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                        height="15" valign="center" align="center">
                                        {{ $key+1 }}
                                    </td>
                                    
                                    <td rowspan="{{ count($value->sampahMasuk) + 1 }}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                        valign="center" align="center">
                                        {{ $value['sopir'] }}
                                    </td>
                
                                    <td rowspan="{{ count($value->sampahMasuk) + 1 }}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                        valign="center" align="center">
                                        {{ $value['nopol'] }}
                                    </td>
                                    
                                    <td rowspan="{{ count($value->sampahMasuk) + 1 }}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                        valign="center" align="center">
                                        {{ $value['jenisKendaraan']['jenis'] }}
                                    </td>
                                    
                                    <td rowspan="{{ count($value->sampahMasuk) + 1 }}" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                        valign="center" align="center">
                                        {{ $value['ruteKendaraan']['rute'] }}
                                    </td>

                                    @php $firstSampah = false; @endphp
                                    
                                @endif
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ $sampah['nomor_bak'] }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{
                                        $carbon::parse($sampah['waktu_masuk'])->locale('id-ID')->translatedFormat('H:i')
                                    }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{
                                        $carbon::parse($sampah['waktu_keluar'])->locale('id-ID')->translatedFormat('H:i')
                                    }}
                                </td>
                                
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ 1 }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ $sampah['berat_masuk'] }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ $sampah['berat_keluar'] }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ $sampah['berat_sampah'] }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                    {{ $sampah['volume'] }}
                                </td>
            
                                <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                    valign="center" align="center">
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                Jumlah
                            </td>
        
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{ $value->sampahMasuk->count('id') }}
                            </td>
        
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{ $value->sampahMasuk->sum('berat_masuk') }}
                            </td>
        
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{ $value->sampahMasuk->sum('berat_keluar') }}
                            </td>
        
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{ $value->sampahMasuk->sum('berat_sampah') }}
                            </td>
        
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                                {{ $value->sampahMasuk->sum('volume') }}
                            </td>
        
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;"
                                valign="center" align="center">
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td rowspan="2" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                height="15" valign="center" align="center">
                                {{ $key+1 }}
                            </td>
                            
                            <td rowspan="2" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $value['sopir'] }}
                            </td>
        
                            <td rowspan="2" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $value['nopol'] }}
                            </td>
                            
                            <td rowspan="2" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $value['jenisKendaraan']['jenis'] }}
                            </td>
                            
                            <td rowspan="2" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;word-wrap: break-word;"
                                valign="center" align="center">
                                {{ $value['ruteKendaraan']['rute'] }}
                            </td>
                            
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center"></td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center"></td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center"></td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center"></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">Jumlah</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center">0</td>
                            <td style="border-top:1px solid #333;border-left: 1px solid #333;border-bottom: 1px solid #333;border-right:1px solid #333;" valign="center" align="center"></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <table>
            <tr>
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
