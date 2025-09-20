<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Certificate of Completion</title>
    <style>
        @page {
            margin: 0px;
        }

        :root {
            /* === Controls (ubah sesuka kamu) === */
            --seal: 96px;
            /* diameter segel keseluruhan */
            --ring-inset: 10px;
            /* jarak core dari tepi segel */
            --outer-ring: 6px;
            /* tebal ring dalam (inner shadow) */
            --outer-border: 4px;
            /* tebal border terluar (::before) */
            --ribbon-w: 74px;
            /* lebar pita bawah segel */
            --ribbon-h: 12px;
            /* tinggi pita bawah segel */

            /* Diameter lingkaran tengah yang memuat ikon 512×512 (diperkecil proporsional) */
            --icon-img: calc(var(--seal) * 0.60);
            /* contoh: 60% dari segel. Naik/turun sesuai selera */
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .certificate {
            width: 100%;
            height: 100%;
            position: relative;
            color: #000;
            background-color: #fff;
        }

        .certificate-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: #2F6A62;
        }

        .certificate-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            background-color: #2F6A62;
        }

        .certificate-content {
            padding: 80px 50px 120px 50px;
            /* ruang bawah agar tidak tabrakan dg signature */
            text-align: center;
        }

        .certificate-title {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #2F6A62;
        }

        .certificate-subtitle {
            font-size: 22px;
            margin-bottom: 30px;
        }

        .student-name {
            font-size: 34px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #000;
            border-bottom: 2px solid #2F6A62;
            display: inline-block;
            padding-bottom: 5px;
        }

        .course-name {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .completion-date {
            font-size: 18px;
            margin-bottom: 30px;
        }

        /* ====== CAP / SEAL VERIFIED (CSS + IMAGE, centered circle matched to icon) ====== */
        .certificate-seal {
            position: relative;
            width: var(--seal);
            height: var(--seal);
            margin: 0 auto 18px;
            border-radius: 50%;
            background: #2F6A62;
            /* warna dasar segel */
            box-shadow:
                inset 0 0 0 var(--outer-ring) rgba(255, 255, 255, 0.18),
                0 5px 10px rgba(0, 0, 0, 0.15);
        }

        .certificate-seal::before {
            content: "";
            position: absolute;
            inset: calc(-1 * var(--outer-ring));
            border-radius: 50%;
            border: var(--outer-border) solid #2A5E56;
        }

        .certificate-seal::after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: calc(-1 * var(--ribbon-h));
            width: var(--ribbon-w);
            height: var(--ribbon-h);
            transform: translateX(-50%);
            background: #264F49;
            clip-path: polygon(0 0, 100% 0, 88% 100%, 12% 100%);
        }

        .seal-core {
            position: absolute;
            inset: var(--ring-inset);
            border-radius: 50%;
            background: #31786D;
            box-shadow: inset 0 0 0 3px rgba(255, 255, 255, 0.22);
        }

        /* Lingkaran tengah yang mengikuti ukuran icon 512px (downscale proporsional) */
        .seal-image {
            position: absolute;
            left: 50%;
            top: 42%;
            transform: translate(-50%, -50%);
            width: var(--icon-img);
            height: var(--icon-img);
            border-radius: 50%;
            overflow: hidden;
            /* clipping jadi lingkaran */
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            /* ring tipis putih di tepi ikon */
            box-shadow:
                0 1px 0 rgba(0, 0, 0, 0.08),
                inset 0 0 0 2px rgba(0, 0, 0, 0.06);
        }

        .seal-image img {
            display: block;
            width: 100%;
            /* isi penuh lingkaran */
            height: 100%;
            object-fit: cover;
            /* ikon 512x512 pas memenuhi lingkaran */
            image-rendering: auto;
            /* downscale halus dari 512px */
        }

        .seal-text {
            position: absolute;
            left: 50%;
            top: 72%;
            transform: translate(-50%, -50%);
            font-weight: 800;
            letter-spacing: 1.2px;
            font-size: 9px;
            color: #fff;
        }

        /* Komponen signature */
        .signature {
            text-align: center;
            width: 220px;
        }

        .signature-image {
            font-family: 'Brush Script MT', cursive;
            font-size: 24px;
            color: #2F6A62;
            margin-bottom: 5px;
        }

        .signature-image img {
            display: block;
            margin: 0 auto 6px;
            max-width: 120px;
            height: auto;
            object-fit: contain;
        }

        .signature-line {
            width: 180px;
            margin: 5px auto;
            border-top: 1px solid #000;
        }

        .signature-name {
            font-weight: bold;
            margin-top: 5px;
            font-size: 16px;
        }

        .signature-title {
            font-style: italic;
            font-size: 14px;
        }

        /* Signature fixed sejajar (kiri & kanan bawah) */
        .signature-fixed-left,
        .signature-fixed-right {
            position: absolute;
            bottom: 70px;
            z-index: 3;
        }

        .signature-fixed-left {
            left: 60px;
        }

        .signature-fixed-right {
            right: 60px;
        }

        /* Border & dekor sudut */
        .certificate-border {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 5px solid #2F6A62;
            pointer-events: none;
            z-index: 1;
        }

        .corner-decoration {
            position: absolute;
            width: 80px;
            height: 80px;
            border: 3px solid #2F6A62;
            z-index: 2;
        }

        .top-left {
            top: 40px;
            left: 40px;
            border-right: none;
            border-bottom: none;
        }

        .top-right {
            top: 40px;
            right: 40px;
            border-left: none;
            border-bottom: none;
        }

        .bottom-left {
            bottom: 40px;
            left: 40px;
            border-right: none;
            border-top: none;
        }

        .bottom-right {
            bottom: 40px;
            right: 40px;
            border-left: none;
            border-top: none;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 22px;
            font-weight: bold;
            color: #fff;
        }

        /* Hindari terpotong saat print/pdf */
        .certificate,
        .signature-fixed-left,
        .signature-fixed-right {
            page-break-inside: avoid;
        }

        /* TAMBAHAN */

        .sig-card {
            width: 260px;
            text-align: center;
            padding: 14px 14px 12px;
            background: rgba(255, 255, 255, .82);
            border: 1px solid rgba(47, 106, 98, .35);
            /* hijau LK samar */
            border-radius: 12px;
            box-shadow:
                0 6px 18px rgba(0, 0, 0, .12),
                inset 0 1px 0 rgba(255, 255, 255, .6);
            backdrop-filter: blur(2px);
        }

        .sig-header {
            font-size: 11px;
            letter-spacing: .6px;
            color: #2F6A62;
            font-weight: 700;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .sig-image img {
            max-height: 64px;
            max-width: 200px;
            object-fit: contain;
            display: block;
            filter: drop-shadow(0 1px 0 rgba(0, 0, 0, .05));
        }

        /* Fallback kalau tidak ada gambar tanda tangan: tampilkan nama ala script */
        .sig-image .sig-script {
            font-family: "Brush Script MT", "Segoe Script", "Comic Sans MS", cursive;
            font-size: 28px;
            color: #2F6A62;
            line-height: 1;
            transform: skewX(-4deg);
        }

        /* Garis tanda tangan dengan semburat hijau */
        .sig-line {
            height: 1.5px;
            width: 200px;
            margin: 6px auto 4px;
            background: linear-gradient(90deg, rgba(47, 106, 98, 0) 0%,
                    rgba(47, 106, 98, .85) 20%,
                    rgba(47, 106, 98, .95) 50%,
                    rgba(47, 106, 98, .85) 80%,
                    rgba(47, 106, 98, 0) 100%);
        }

        /* Nama & jabatan */
        .sig-name {
            font-weight: 800;
            font-size: 15px;
            margin-top: 4px;
            color: #0b0b0c;
        }

        .sig-role {
            font-size: 12px;
            font-style: italic;
            color: #333;
        }

        /* Chip kecil di bawah: “Signed electronically” + tanggal */
        .sig-meta {
            display: flex;
            gap: 8px;
            justify-content: center;
            align-items: center;
            margin-top: 8px;
        }

        .sig-chip {
            font-size: 10px;
            padding: 3px 6px;
            border-radius: 999px;
            border: 1px solid rgba(47, 106, 98, .35);
            background: linear-gradient(180deg, rgba(224, 234, 232, .9), rgba(191, 227, 220, .75));
            color: #264F49;
            font-weight: 600;
            white-space: nowrap;
        }

        .sig-date {
            font-size: 10px;
            color: #444;
        }

        /* Opsi QR/ID verifikasi (aktifkan bila perlu) */
        .sig-verify {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 8px;
            justify-content: center;
            font-size: 10px;
            color: #2A5E56;
        }

        .sig-verify img {
            width: 16px;
            height: 16px;
            display: block;
        }

        /* Posisi tetap kiri-bawah (pakai yang sudah ada) */
        .signature-fixed-left {
            position: absolute;
            bottom: 62px;
            left: 60px;
            z-index: 3;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="certificate-header">
        </div>

        <div class="certificate-border"></div>
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>

        <div class="certificate-content">
            <div class="certificate-title">CERTIFICATE OF COMPLETION</div>
            <div class="certificate-subtitle">This certificate is awarded to</div>

            <div class="student-name">{{ $user->name }}</div>

            <div class="certificate-subtitle">for successfully completing the course</div>

            <div class="course-name">{{ $course->name }}</div>

            <div class="completion-date">Completed on {{ $completedAt->format('F d, Y') }}</div>

            <!-- === CAP / SEAL VERIFIED (CSS + IMAGE, circle sized to the icon) === -->
            <div class="certificate-seal">
                <div class="seal-core"></div>
                <div class="seal-image">
                    <!-- pakai ikon 512×512 yang kamu kirim -->
                    <img src="{{ public_path('assets/images/signature/checked.png') }}" alt="Verified Icon">
                    <!-- Jika filemu bernama lain / lokasi lain, sesuaikan path di atas -->
                </div>
                <div class="seal-text">VERIFIED</div>
            </div>
            <!-- === END SEAL === -->
        </div>

        <!-- Kiri bawah: Course Instructor -->
        <!-- Kiri bawah: Course Instructor (Upgraded) -->
        <div class="signature-fixed-left">
            <div class="sig-card">
                <div class="sig-header">Course Instructor</div>

                <div class="sig-image">
                    @php
                        // Opsi: jika punya gambar tanda tangan mentor, isi $mentorSignaturePath absolut (public_path)
                        $hasSignatureImage = !empty($mentorSignaturePath ?? null);
                    @endphp

                    @if ($hasSignatureImage)
                        <img src="{{ $mentorSignaturePath }}" alt="Instructor Signature">
                    @else
                        <!-- Fallback: tulis nama ala script -->
                        <div class="sig-script">{{ $mentorName }}</div>
                    @endif
                </div>

                <div class="sig-line"></div>

                <div class="sig-name">{{ $mentorOccupation }}</div>

                {{-- Aktifkan verifikasi kalau sudah siap --}}
                {{--
    <div class="sig-verify">
      <img src="{{ public_path('assets/images/signature/check-mini.png') }}" alt="">
      <span>Verify ID: {{ $certificateCode }}</span>
    </div>
    --}}
            </div>
        </div>


        <!-- Kanan bawah: Lingkaran Koding -->
        <div class="signature-fixed-right">
            <div class="signature">
                <div class="signature-image">
                    <img src="{{ public_path('assets/images/signature/signature-lingkarankoding.png') }}"
                        alt="LK signature">
                </div>
                <div class="signature-line"></div>
                <div class="signature-name">Lingkaran Koding</div>
                <div class="signature-title">Platform Director</div>
            </div>
        </div>

        <div class="certificate-footer"></div>
    </div>
</body>

</html>
