<table border="1" cellpadding="10" cellspacing="0" style="width: 100%">
    <tr>
        <th style="width:20px"></th>
        <th style="width:30px"></th>
        <th style="width:45px"></th>
        <th style="width:300px"></th>
        <th style="width: 120px"></th>
        <th style="width: 120px"></th>
        <th style="width: 120px"></th>
        <th style="width: 120px"></th>
        <th style="width:120px"></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th colspan="11" style="text-align: center">
            LAPORAN PENYERAPAN ANGGARAN DAN PENGADAAN BARANG/JASA
        </th>
    </tr>
    <tr>
        <th colspan="11" style="text-align: center">
            SKPD {{ $user->name }} KABUPATEN INDRAMAYU
        </th>
    </tr>
    <tr>
        <th colspan="11" style="text-align: center">
            {{ $triwulan_awal }} SAMPAI
            {{ $triwulan_akhir }} TAHUN ANGGARAN
            {{ $triwulan_akhir_tahun }}
        </th>
    </tr>
    <tr></tr>
    <tr>
        <th>A.</th>
        <th colspan="3" style="font-weight: bold">INFORMASI HUKUM</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th colspan="3" style="text-align: left">NAMA SKPD</th>
        <th style="text-align: left">: {{ $user->name }}</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th colspan="3" style="text-align: left">ALAMAT</th>
        <th style="text-align: left">: {{ $user->alamat }}</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th>B.</th>
        <th colspan="3">HASIL REVIU APIP</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th>1. </th>
        <th colspan="2">Reviu Realisasi Pendapatan (Untuk SKDP Penghasil)</th>

    </tr>
    <tr>

    </tr>
    <tr>
        <th></th>
        <th></th>
        <th>a. Target Pendapatan Daerah</th>

    </tr>
    <tr>

    </tr>
    <tr>
        <th></th>
        <th></th>
        <th rowspan="2" style="vertical-align: middle;text-align:center">No</th>
        <th rowspan="2" style="text-align: center;vertical-align:middle">Jenis Pendapatan</th>
        <th colspan="4" style="text-align: center">Target Pendapatan (Rp.)</th>
        <th rowspan="2" style="text-align: center">Total Target <br> Pendapatan (Rp.)</th>
        <th colspan="4" style="text-align: center">Realisasi Pendapatan (Rp.)</th>
        <th rowspan="2" style="text-align: center">Total Realisasi <br> Pendapatan (Rp.)</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        @foreach ($data_triwulan as $triwulan)
            <th style="text-align: center">{{ $triwulan->nama }}</th>
        @endforeach
        @foreach ($data_triwulan as $triwulan)
            <th style="text-align: center">{{ $triwulan->nama }}</th>
        @endforeach
    </tr>

    <!-- jenis pendapatan -->
    @foreach ($data_pendapatan->get() as $pend)
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
            <td>{{ $pend->jenis_pendapatan }}</td>
            {{-- target pendapatan --}}
            @foreach ($data_triwulan as $triwulan)
                <td style="text-align: right; width:120px">
                    {{ $pend->details()->where('triwulan_id', $triwulan->id)->sum('target_pendapatan') ?? 0 }}
                </td>
            @endforeach
            <td style="text-align: right; width:120px">{{ $pend->details()->sum('target_pendapatan') }}</td>
            {{-- realisasi pendapatan --}}
            @foreach ($data_triwulan as $triwulan)
                <td style="text-align: right; width:120px">
                    {{ $pend->details()->where('triwulan_id', $triwulan->id)->sum('realisasi_pendapatan') ?? 0 }}
                </td>
            @endforeach
            <td style="text-align: right; width:120px">{{ $pend->details()->sum('realisasi_pendapatan') }}</td>
        </tr>
    @endforeach


    {{-- identifikasi masalah terkait realisasi pendapatan --}}
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="4">b. Identifikasi permasalahan terkait realisasi pendapatan sebagai berikut :</td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: center">No.</td>
        <td style="text-align: center">Permasalahan/Kamus Masalah</td>
        <td colspan="5" style="text-align: center">Penyebab Permasalahan/Rekomendasi</td>
        <td style="text-align: center" colspan="2">Rekomendasi</td>
    </tr>
    @foreach ($data_permasalahan_pendapatan as $permasalahan_pendapatan)
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
            <td style="text-align: center">{{ $permasalahan_pendapatan->permasalahan }}</td>
            <td style="text-align: center" colspan="5">{{ $permasalahan_pendapatan->penyebab }}</td>
            <td style="text-align: center" colspan="2">{{ $permasalahan_pendapatan->rekomendasi }}</td>
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th>2. </th>
        <th colspan="2">Reviu Penyerapan Anggaran</th>

    </tr>
    <tr>

    </tr>
    <tr>
        <th></th>
        <th></th>
        <th>a. Rencana Penarikan Dana/Anggaran Kas</th>
    </tr>
    <tr>

    </tr>
    <tr>
        <th></th>
        <th></th>
        <th rowspan="2" style="vertical-align: middle;text-align:center">No</th>
        <th rowspan="2" style="text-align: center;vertical-align:middle">Jenis Belanja</th>
        <th colspan="4" style="text-align: center">Target Belanja (Rp.)</th>
        <th rowspan="2" style="text-align: center">Total Target <br> Belanja (Rp.)</th>
        <th colspan="4" style="text-align: center">Realisasi Belanja (Rp.)</th>
        <th rowspan="2" style="text-align: center">Total Realisasi <br> Belanja (Rp.)</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        @foreach ($data_triwulan as $triwulan)
            <th style="text-align: center">{{ $triwulan->nama }}</th>
        @endforeach
        @foreach ($data_triwulan as $triwulan)
            <th style="text-align: center">{{ $triwulan->nama }}</th>
        @endforeach
    </tr>

    <!-- jenis belanja -->
    @foreach ($data_penarikan_dana_anggaran->get() as $penarikan_anggaran)
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
            <td>{{ $penarikan_anggaran->jenis_belanja }}</td>
            {{-- target belanja --}}
            @foreach ($data_triwulan as $triwulan)
                <td style="text-align: right; width:120px">
                    {{ $penarikan_anggaran->details()->where('triwulan_id', $triwulan->id)->sum('target_belanja') ?? 0 }}
                </td>
            @endforeach
            <td style="text-align: right; width:120px">{{ $penarikan_anggaran->details()->sum('target_belanja') }}
            </td>
            {{-- realisasi belanja --}}
            @foreach ($data_triwulan as $triwulan)
                <td style="text-align: right; width:120px">
                    {{ $penarikan_anggaran->details()->where('triwulan_id', $triwulan->id)->sum('realisasi_belanja') ?? 0 }}
                </td>
            @endforeach
            <td style="text-align: right; width:120px">
                {{ $penarikan_anggaran->details()->sum('realisasi_belanja') }}</td>
        </tr>
    @endforeach
    {{-- identifikasi permasalahan anggaran --}}
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="4">b. Identifikasi permasalahan terkait realisasi belanja sebagai berikut :</td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: center">No.</td>
        <td style="text-align: center">Permasalahan/Kamus Masalah</td>
        <td colspan="5" style="text-align: center">Penyebab Permasalahan/Rekomendasi</td>
        <td style="text-align: center" colspan="2">Rekomendasi</td>
    </tr>
    @foreach ($data_permasalahan_anggaran as $permasalahan_anggaran)
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
            <td style="text-align: center">{{ $permasalahan_anggaran->permasalahan }}</td>
            <td style="text-align: center" colspan="5">{{ $permasalahan_anggaran->penyebab }}</td>
            <td style="text-align: center" colspan="2">{{ $permasalahan_anggaran->rekomendasi }}</td>
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th>3. </th>
        <th colspan="2">Reviu Penyerapan Anggaran Per Urusan</th>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: center">No.</td>
        <td style="text-align: center" colspan="5">Urusan Pemerintahan</td>
        <td style="text-align: center">Target (Rp.)</td>
        <td style="text-align: center">Realisasi (Rp.)</td>
    </tr>
    @foreach ($data_penyerapan_anggaran_urusan as $penyerapan_anggaran_urusan)
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
            <td style="text-align: center" colspan="5">{{ $penyerapan_anggaran_urusan->urusan_pemerintahan }}</td>
            <td style="text-align: right">{{ $penyerapan_anggaran_urusan->target }}</td>
            <td style="text-align: right">{{ $penyerapan_anggaran_urusan->realisasi }}</td>
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th>4. </th>
        <th colspan="2">Reviu Pendanaan Penanganan Covid 19</th>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td style="text-align: center">No.</td>
        <td style="text-align: center">Fokus</td>
        <td style="text-align: center" colspan="4">Program/Kegiatan</td>
        <td style="text-align: center">Target (Rp.)</td>
        <td style="text-align: center">Realisasi (Rp.)</td>
    </tr>
    @foreach ($data_pendanaan_covid19 as $pendanaan_covid19)
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
            <td style="text-align: center">{{ $pendanaan_covid19->fokus }}</td>
            <td style="text-align: center" colspan="4">{{ $pendanaan_covid19->program }}</td>
            <td style="text-align: right">{{ $pendanaan_covid19->target }}</td>
            <td style="text-align: right">{{ $pendanaan_covid19->realisasi }}</td>
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr>
        <th></th>
        <th>5. </th>
        <th colspan="2">Reviu Pengadaan Barang dan Jasa</th>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td colspan="4">a. Target PBJ berikut :</td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td rowspan="2" style="vertical-align: middle;text-align:center">No.</td>
        <td rowspan="2" style="vertical-align: middle;text-align:center">Target PBJ</td>
        @foreach ($data_jenis_barjas as $barjas)
            <td colspan="2" style="text-align: center">{{ $barjas->nama }}</td>
        @endforeach
    </tr>
    <tr>
        <td></td>
        <td></td>
        @foreach ($data_jenis_barjas as $barjas)
            <td style="text-align: center">Paket</td>
            <td style="text-align: center">Nilai</td>
        @endforeach
    </tr>
    @foreach ($data_target_pbj as $target_pbj)
        <tr>
            <td></td>
            <td></td>
            <td style="vertical-align: middle;text-align:center">{{ $loop->iteration }}</td>
            <td>
                {{ $target_pbj->triwulan->nama }}
            </td>
            @foreach ($data_jenis_barjas as $barjas)
                <td style="text-align: center">
                    {{ $target_pbj->details()->where('jenis_barang_jasa_id', $barjas->id)->sum('paket') }}
                </td>
                <td style="text-align: center">
                    {{ $target_pbj->details()->where('jenis_barang_jasa_id', $barjas->id)->sum('nilai') }}
                </td>
            @endforeach
        </tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    @php
        $abjad = range('b', 'z');
    @endphp
    @foreach ($data_triwulan as $key => $realisasi_triwulan)
        <tr>
            <td></td>
            <td></td>
            <td colspan="4">{{ $abjad[$key] }}. Realisasi PBJ {{ $realisasi_triwulan->nama }} sebagai berikut :
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td rowspan="2" style="vertical-align: middle;text-align:center">No.</td>
            <td rowspan="2" style="vertical-align: middle;text-align:center">Tahapan Pengadaan Barjas</td>
            @foreach ($data_jenis_barjas as $barjas)
                <td colspan="2" style="text-align: center">{{ $barjas->nama }}</td>
            @endforeach
        </tr>
        <tr>
            <td></td>
            <td></td>
            @foreach ($data_jenis_barjas as $barjas)
                <td style="text-align: center">Paket</td>
                <td style="text-align: center">Nilai</td>
            @endforeach
        </tr>
        {{-- {{ dd($data_realisasi_pbj->where('triwulan_id', 2)->get()) }} --}}
        @foreach (App\Models\RealisasiPbj::where('user_id', $user->id)->where('triwulan_id', $realisasi_triwulan->id)->get() as $realisasi_pbj)
            <tr>
                <td></td>
                <td></td>
                {{-- @if ($realisasi_pbj->where('triwulan_id', $triwulan->id)->count() > 0) --}}
                <td style="vertical-align: middle;text-align:center">{{ $loop->iteration }}</td>
                <td>
                    {{ $realisasi_pbj->tahapan ?? '' }}
                </td>
                @foreach ($data_jenis_barjas as $barjas)
                    <td style="text-align: center">

                        @if ($realisasi_pbj->first()->details()->count() > 0)
                            {{ $realisasi_pbj->first()->details()->where('jenis_barang_jasa_id', $barjas->id)->sum('paket') }}
                        @else
                        @endif
                    </td>
                    <td style="text-align: center">
                        @if ($realisasi_pbj->first()->details()->count() > 0)
                            {{ $realisasi_pbj->first()->details()->where('jenis_barang_jasa_id', $barjas->id)->sum('nilai') }}
                        @else
                        @endif

                    </td>
                @endforeach
                {{-- @endif --}}
            </tr>
        @endforeach
        <tr></tr>
        <tr></tr>
    @endforeach
    <tr></tr>

    @foreach ($data_triwulan as $key => $triwulan)
        <tr>
            <td></td>
            <td></td>
            <td colspan="4">{{ $abjad[$data_triwulan->count() + $key] }}. Identifikasi permasalahan terkait PBJ
                pada
                {{ $triwulan->nama }} sebagai berikut :
            </td>
        </tr>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            <td style="text-align: center">No.</td>
            <td style="text-align: center">Permasalahan/Kamus Masalah</td>
            <td colspan="5" style="text-align: center">Penyebab Permasalahan/Rekomendasi</td>
            <td style="text-align: center" colspan="2">Rekomendasi</td>
        </tr>
        @foreach (App\Models\PermasalahanPbj::where('user_id', $user->id)->where('triwulan_id', $triwulan->id)->get() as $permasalahan_pbj)
            <tr>
                <td></td>
                <td></td>
                <td style="text-align: center">{{ $loop->iteration . '.' }}</td>
                <td style="text-align: center">
                    {{ $permasalahan_pbj->permasalahan }}</td>
                <td style="text-align: center" colspan="5">
                    {{ $permasalahan_pbj->penyebab }}</td>
                <td style="text-align: center" colspan="2">
                    {{ $permasalahan_pbj->rekomendasi }}</td>
            </tr>
        @endforeach
        <tr></tr>
    @endforeach
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            Indramayu, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </td>
    </tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center">
            Kepala SKPD {{ $user->nama_kepala_skpd }} <br>
            Kabupaten Indramayu
        </td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align: center">
            NIP. {{ $user->nip }}
        </td>
    </tr>
</table>
