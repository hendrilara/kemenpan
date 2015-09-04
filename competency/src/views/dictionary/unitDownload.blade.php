<!DOCTYPE html>
<html lang="en">
<head>

    <title>Kamus Kompetensi MSDM-TBK</title>
    <style>
        @page {
            margin-top: 100px;
            margin-bottom: 80px;
        }
        body {
            font-family: "Calibri", "Helvetica Neue Light", "Lucida Grande", "Arial" sans-serif;
        }
        h3 {
            -webkit-box-shadow: 0px 2px 0px #ddd;
            -moz-box-shadow: 0px 2px 0px #ddd;
            box-shadow: 0px 2px 0px #ddd;
        }

        #footer {
            position: fixed;
            bottom: 0px;
            left: 0px;
            right: 0px;
            height: 30px;
            padding-top: 20px;
            text-align: center;
            border-top: 2px solid gray;
        }
        .pagenum:before {
            content: counter(page);
        }

        /*
         * table
        */
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        table {
            background-color: transparent;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #ddd;
        }
        .table-bordered>thead>tr>th, .table-bordered>thead>tr>td {
            border-bottom-width: 2px;
        }
        .table>caption+thead>tr:first-child>th, .table>colgroup+thead>tr:first-child>th, .table>thead:first-child>tr:first-child>th, .table>caption+thead>tr:first-child>td, .table>colgroup+thead>tr:first-child>td, .table>thead:first-child>tr:first-child>td {
            border-top: 0;
        }
        .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1px solid #ddd;
        }
        .table>thead>tr>th {
            vertical-align: bottom;
            border-bottom: 2px solid #ddd;
        }
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border-top: 1px solid #ddd;
        }
        th {
            text-align: left;
        }
        td, th {
            padding: 0;
        }
        .table-title-komp {
            text-align: center;
            background-color: #3498db;
            color: #fff;

        }
    </style>
</head>
<body>
@foreach ($profiles as $profile)
<table class="table table-bordered">
    <thead>
    <tr>
        <th colspan="2" class="table-title-komp">{{ $profile->competency_dictionary['title'] }} ({{ $profile->competency_dictionary['code'] }})</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Definisi</td>
        <td>{{ $profile->competency_dictionary['description'] }}</td>
    </tr>
    <?php $detail = json_decode($profile->competency_dictionary['detail']); ?>
    @if (is_object($detail))
    @foreach($detail as $key => $row)
    <tr>
        <td>{{ $key }}</td>
        <td>{{ $row }}</td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>
<h3>Skala</h3>
<hr/>
<?php //dd($profile->competency_dictionary['level']); ?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th>level</th>
        <th>Penjelasan Indikator Perilaku Pemegang Jabatan</th>
    </tr>
    </thead>
    <tbody>
    @if (is_object($profile->competency_dictionary['level']))
    @foreach($profile->competency_dictionary->level as $level)
    <tr>
        <td>{{ $level->value }}</td>
        <td>
            <strong>{{ $level->title }}</strong> <br>
            {{ $level->description }}
        </td>
    </tr>
    @endforeach
    @endif
    </tbody>
</table>
<div id="footer">
    <p>Halaman <span class="pagenum"></span></p>
</div>
<div style="page-break-before: always;"></div>
@endforeach
</body>
</html>