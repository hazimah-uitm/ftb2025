<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $registration->user->institution_name }} - Dokumen Penyertaan FTB2025</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        h3,
        h4 {
            text-align: center;
            margin: 2px 0;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }

        .logo-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .checkbox {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
        }

        .tickbox {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
        }
    </style>
</head>

<body>

    @include('pages.registration.pdf_surat')

    <div style="page-break-after: always;"></div>

    @include('pages.registration.pdf_borang')
</body>

</html>
