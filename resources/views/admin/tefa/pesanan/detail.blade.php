@extends('admin.tefa.layouts.app')

@section('content')

<style>
    .detail-page {
        max-width: 1056px;
        margin: 0 auto;
    }

    .detail-header {
        margin-bottom: 18px;
    }

    .detail-header h1 {
        font-size: 28px;
        line-height: 1.2;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .detail-header p {
        font-size: 13px;
        color: #64748b;
        margin: 4px 0 0;
    }

    .detail-back {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dbe2ea;
        background: white;
        border-radius: 9px;
        color: #475569;
        text-decoration: none;
    }

    .detail-back:hover {
        background: #f8fafc;
        color: #4f46e5;
    }

    .detail-card {
        background: white;
        border: 1px solid #dbe2ea;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
    }

    .order-head {
        padding: 14px 18px;
    }

    .order-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .label {
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .35px;
        margin-bottom: 3px;
    }

    .value {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }

    .section-card {
        padding: 18px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #334155;
        margin: 0;
    }

    .section-desc {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 3px;
        margin-bottom: 18px;
    }

    .info-value {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    .note-box {
        background: #f8fafc;
        border-radius: 9px;
        padding: 11px 13px;
        font-size: 12px;
        color: #64748b;
        line-height: 1.5;
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .summary-item:last-child {
        margin-bottom: 0;
    }

    .summary-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .worker-empty {
        background: #f8fafc;
        border-radius: 10px;
        padding: 18px 12px;
        text-align: center;
    }

    .worker-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        margin: 0 auto 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #94a3b8;
    }

    .action-btn {
        width: 100%;
        height: 36px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
</style>


<div class="detail-page">

    {{-- HEADER --}}
    <div class="detail-header d-flex align-items-center gap-3">

        <a
            href="{{ route('admin.tefa.pesanan') }}"
            class="detail-back">

            <i class="bi bi-arrow-left"></i>

        </a>

        <div>

            <h1>Detail Pesanan</h1>

            <p>
                Lihat informasi lengkap dan kelola pesanan klien
            </p>

        </div>

    </div>


    {{-- IDENTITAS PESANAN --}}
    <div class="detail-card order-head mb-4">

        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-3">

                <div class="order-icon">
                    <i class="bi bi-receipt"></i>
                </div>

                <div>

                    <div class="label">
                        ID Pesanan
                    </div>

                    <div
                        style="
                            font-size:20px;
                            font-weight:700;
                            color:#4f46e5;
                        ">

                        #TF-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}

                    </div>

                </div>

            </div>


            {{-- STATUS --}}
            @if($pesanan->status === 'pending')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#fff7ed;
                        color:#ea580c;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Pending

                </span>

            @elseif($pesanan->status === 'in_progress')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#eff6ff;
                        color:#2563eb;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Dalam Pengerjaan

                </span>

            @elseif($pesanan->status === 'completed')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#ecfdf5;
                        color:#059669;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Selesai

                </span>

            @elseif($pesanan->status === 'cancelled')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#fef2f2;
                        color:#dc2626;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Ditolak / Batal

                </span>

            @endif

        </div>

    </div>


    {{-- MAIN --}}
    <div class="row g-4">


        {{-- KIRI --}}
        <div class="col-lg-8">


            {{-- INFORMASI PESANAN --}}
            <div class="detail-card mb-4">

                <div class="section-card">

                    <h2 class="section-title">
                        Informasi Pesanan
                    </h2>

                    <div class="section-desc">
                        Detail layanan yang dipesan oleh klien
                    </div>


                    <div class="row g-4">


                        <div class="col-md-6">

                            <div class="label">
                                Layanan
                            </div>

                            <div class="info-value">
                                {{ $pesanan->tefa->nama_produk ?? '-' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="label">
                                Jurusan
                            </div>

                            <div class="info-value">
                                {{ $pesanan->tefa->jurusan ?? '-' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="label">
                                Nilai Pesanan
                            </div>

                            <div class="info-value">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="label">
                                Tanggal Pesanan
                            </div>

                            <div class="info-value">
                                {{ $pesanan->tanggal_pesan?->format('d M Y') ?? '-' }}
                            </div>

                            <div
                                style="
                                    font-size:11px;
                                    color:#94a3b8;
                                    margin-top:2px;
                                ">

                                {{ $pesanan->tanggal_pesan?->format('H:i') ?? '-' }} WIB

                            </div>

                        </div>

                    </div>


                    <div
                        class="border-top mt-4 pt-4">

                        <div class="label">
                            Catatan Pesanan
                        </div>

                        <div class="note-box">

                            {{ $pesanan->catatan_pesanan ?: 'Tidak ada catatan dari klien.' }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- DATA KLIEN --}}
            <div class="detail-card">

                <div class="section-card">

                    <h2 class="section-title">
                        Data Klien
                    </h2>

                    <div class="section-desc">
                        Informasi kontak pemesan
                    </div>


                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="label">
                                Nama Klien
                            </div>

                            <div class="info-value">
                                {{ $pesanan->nama_pemesan ?? '-' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="label">
                                Email
                            </div>

                            <div class="info-value">
                                {{ $pesanan->email_pemesan ?? '-' }}
                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="label">
                                Nomor WhatsApp
                            </div>

                            <div class="info-value">
                                {{ $pesanan->no_hp_pemesan ?? '-' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- KANAN --}}
        <div class="col-lg-4">


            {{-- RINGKASAN --}}
            <div class="detail-card mb-4">

                <div class="section-card">

                    <h2 class="section-title">
                        Ringkasan Pesanan
                    </h2>

                    <div class="section-desc">
                        Informasi singkat pesanan
                    </div>


                    <div class="summary-item">

                        <div
                            class="summary-icon"
                            style="
                                background:#eef2ff;
                                color:#4f46e5;
                            ">

                            <i class="bi bi-person"></i>

                        </div>

                        <div>

                            <div class="label mb-0">
                                Klien
                            </div>

                            <div class="value">
                                {{ $pesanan->nama_pemesan ?? '-' }}
                            </div>

                        </div>

                    </div>


                    <div class="summary-item">

                        <div
                            class="summary-icon"
                            style="
                                background:#eff6ff;
                                color:#2563eb;
                            ">

                            <i class="bi bi-box-seam"></i>

                        </div>

                        <div>

                            <div class="label mb-0">
                                Layanan
                            </div>

                            <div class="value">
                                {{ $pesanan->tefa->nama_produk ?? '-' }}
                            </div>

                        </div>

                    </div>


                    <div class="summary-item">

                        <div
                            class="summary-icon"
                            style="
                                background:#ecfdf5;
                                color:#059669;
                            ">

                            <i class="bi bi-cash-stack"></i>

                        </div>

                        <div>

                            <div class="label mb-0">
                                Total
                            </div>

                            <div class="value">
                                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- WORKER --}}
            <div class="detail-card mb-4">

                <div class="section-card">

                    <h2 class="section-title">
                        Worker
                    </h2>

                    <div class="section-desc">
                        Penanggung jawab pesanan
                    </div>


                    @if($pesanan->worker)

                        <div class="d-flex align-items-center gap-3">

                            <div
                                class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                style="
                                    width:38px;
                                    height:38px;
                                    background:#eef2ff;
                                    color:#4f46e5;
                                ">

                                {{ strtoupper(substr($pesanan->worker->nama, 0, 1)) }}

                            </div>

                            <div>

                                <div class="value">
                                    {{ $pesanan->worker->nama }}
                                </div>

                                <div
                                    style="
                                        font-size:11px;
                                        color:#94a3b8;
                                    ">

                                    Worker

                                </div>

                            </div>

                        </div>

                    @else

                        <div class="worker-empty">

                            <div class="worker-icon">

                                <i class="bi bi-person-plus"></i>

                            </div>

                            <div
                                style="
                                    font-size:13px;
                                    font-weight:600;
                                    color:#475569;
                                ">

                                Belum ditugaskan

                            </div>

                            <div
                                style="
                                    font-size:11px;
                                    color:#94a3b8;
                                    margin-top:2px;
                                ">

                                Worker belum dipilih.

                            </div>

                        </div>

                    @endif

                </div>

            </div>


            {{-- AKSI --}}
            <div class="detail-card">

                <div class="section-card">

                    <h2 class="section-title">
                        Aksi Pesanan
                    </h2>

                    <div class="section-desc">
                        Kelola proses pesanan
                    </div>


                    <!-- Tombol untuk memicu/membuka Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProsesPesanan">
                        <i class="fas fa-tasks me-1"></i> Proses Pesanan
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>

    <!-- Modal Proses & Lempar Pesanan -->
    <div class="modal fade" id="modalProsesPesanan" tabindex="-1" aria-labelledby="modalProsesPesananLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="modalProsesPesananLabel">Proses & Lempar Pesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="{{ route('admin.tefa.pesanan.proses', $pesanan->id_pesanan ?? $pesanan->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        
                        <!-- 1. Select Status Pesanan -->
                        <div class="mb-3">
                            <label for="status" class="form-label font-weight-bold">Status Pesanan</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="diproses" {{ ($pesanan->status ?? '') == 'diproses' ? 'selected' : '' }}>Diproses (Teruskan ke Jurusan)</option>
                                <option value="selesai" {{ ($pesanan->status ?? '') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="ditolak" {{ ($pesanan->status ?? '') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <!-- 2. Select Lempar ke Admin Jurusan -->
                        <div class="mb-3">
                            <label for="jurusan_id" class="form-label font-weight-bold">Lempar ke Admin Jurusan</label>
                            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                                {{-- Bikin default selected + disabled biar wajib milih --}}
                                <option value="" disabled {{ empty($pesanan->jurusan_id) ? 'selected' : '' }}>-- Pilih Jurusan Tujuan --</option>
                                @foreach($listJurusan as $jurusan)
                                    <option value="{{ $jurusan->id ?? $jurusan->id_jurusan }}" {{ ($pesanan->jurusan_id ?? '') == ($jurusan->id ?? $jurusan->id_jurusan) ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Pesanan akan masuk dan dapat dikelola di dashboard Admin Jurusan ini.</small>
                        </div>

                        <!-- 3. Catatan / Keterangan -->
                        <div class="mb-3">
                            <label for="catatan" class="form-label font-weight-bold">Catatan / Instruksi Pengerjaan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="3" placeholder="Masukkan instruksi khusus untuk Admin Jurusan / Worker..."></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan & Teruskan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>

    function openProsesModal() {

        const modal = document.getElementById('prosesPesananModal');

        modal.classList.remove('hidden');
        modal.classList.add('flex');

    }


    function closeProsesModal() {

        const modal = document.getElementById('prosesPesananModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');

    }

    </script>








@endsection