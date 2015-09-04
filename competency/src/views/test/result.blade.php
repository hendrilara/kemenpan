@section('customcss')

@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <!--widget start-->
        <div class="panel">
            <div class="panel-body">
                {{ Form::open(array('url' => Request::url(), 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    <label for="Tahun Cli" class="col-lg-2 col-sm-2 control-label">Tahun Cli</label>
                    <div class="col-lg-10">
                        <select class="form-control" name="cli">
                            <option value="2013">2013</option>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Check</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </div>
        <!--widget end-->
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <!--widget start-->
        <div class="panel">
            <div class="panel-body">
                <div class="bio-chart">
                    <div style="display:inline;width:101px;height:101px;"><canvas width="101" height="101px"></canvas><input class="knob" data-width="101" data-height="101" data-displayprevious="true" data-thickness=".2" value="80.4878" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
                </div>
                <div class="bio-desk">
                    <h4 class="terques"><a href="#"> Kompetensi Inti dan managerial </a></h4>
                    <p>Total Kompetensi : 15</p>
                    <p>Jumlah Kompetensi Tercapai  : 5</p>
                </div>
            </div>
        </div>
        <!--widget end-->
    </div>

    <div class="col-md-6">
        <!--widget start-->
        <div class="panel">
            <div class="panel-body">
                <div class="bio-chart">
                    <div style="display:inline;width:101px;height:101px;"><canvas width="101" height="101px"></canvas><input class="knob" data-width="101" data-height="101" data-displayprevious="true" data-thickness=".2" value="100" data-fgcolor="#4CC5CD" data-bgcolor="#e8e8e8" style="width: 54px; height: 33px; position: absolute; vertical-align: middle; margin-top: 33px; margin-left: -77px; border: 0px; font-weight: bold; font-style: normal; font-variant: normal; font-size: 20px; line-height: normal; font-family: Arial; text-align: center; color: rgb(76, 197, 205); padding: 0px; -webkit-appearance: none; background: none;"></div>
                </div>
                <div class="bio-desk">
                    <h4 class="terques"><a href="#"> Kompetensi Fungsional </a></h4>
                    <p>Total Kompetensi : 10</p>
                    <p>Jumlah Kompetensi Tercapai  : 10</p>
                </div>
            </div>
        </div>
        <!--widget end-->
    </div>
</div>

<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
    Hasil Kompetensi Individu
</header>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li class="active"><a href="#soft" role="tab" data-toggle="tab">Soft</a></li>
    <li><a href="#business" role="tab" data-toggle="tab">Business</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div class="tab-pane active" id="soft">
<table class="table table-bordered table-striped table-advance table-hover">
<thead>
<tr>
    <th>Kode</th>
    <th>Nama Kompetensi</th>
    <th>RCL</th>
    <th>CCL</th>
    <th>GAP</th>
    <th>Detail</th>
</tr>
</thead>
<tbody>
<tr class="warning">
    <td>KM.01.KSP.03.201</td>
    <td>Pemikiran Konseptual (Conceptual Thinking)</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;2&quot;}]"> 2.67 </a></td>
    <td>-0.33</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1537" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr class="danger">
    <td>KI.02.SPT.01.2014</td>
    <td>Semangat Berprestasi (Achievement Orientation)</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;2&quot;}]"> 2.33 </a></td>
    <td>-0.67</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1538" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr class="warning">
    <td>KI.02.KOG.02.2014</td>
    <td>Komitmen Organisasi (Organizational Commitment)</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 2.83 </a></td>
    <td>-0.17</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1539" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr class="danger">
    <td>KM.04.KPK.15.2014.A</td>
    <td>Kekuatan peran kepemimpinan</td>
    <td>4</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.33 </a></td>
    <td>-0.67</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1540" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KI.02.AHL.03.2014.A</td>
    <td>Kedalaman Pengetahuan</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3 </a></td>
    <td>0</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1541" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KM.04.KPK.15.2014.B</td>
    <td>Besarnya usaha atau inisiatif untuk memimpin kerja kelompok</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.33 </a></td>
    <td>0.33</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1542" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr class="danger">
    <td>KM.03.RCN.09.2014</td>
    <td>Perencanaan (Planning)</td>
    <td>4</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.33 </a></td>
    <td>-0.67</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1543" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KI.02.AHL.03.2014.B</td>
    <td>Penguasaan Keilmuan</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;1&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;5&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3 </a></td>
    <td>0</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1544" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KM.03.PDL.10.2014</td>
    <td>Pengendalian (Controlling)</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;5&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.33 </a></td>
    <td>0.33</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1545" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KM.03.PKT.11.2014</td>
    <td>Perhatian Terhadap Kejelasan Tugas (Concern For Order)</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.17 </a></td>
    <td>0.17</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1546" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr class="danger">
    <td>KI.02.AHL.03.2014.C</td>
    <td>Penyebaran Pengetahuan yang Dimiliki</td>
    <td>4</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.17 </a></td>
    <td>-0.83</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1547" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KI.02.OPP.04.2014.A</td>
    <td>Fokus Pada Kebutuhan Pengguna Hasil Kerja (Customer)</td>
    <td>3</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3 </a></td>
    <td>0</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1548" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KI.02.OPP.04.2014.B</td>
    <td>Inisiatif (Usaha yang Dilakukan) untuk Melayani</td>
    <td>2</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;5&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3 </a></td>
    <td>1</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1549" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr class="danger">
    <td>KM.01.INF.01.2014</td>
    <td>Pencarian Informasi (Information Seeking)</td>
    <td>4</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.17 </a></td>
    <td>-0.83</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1550" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
<tr>
    <td>KM.01.ANT.02.2014</td>
    <td>Pemikiran Analitis (Analytical Thinking)</td>
    <td>2</td>
    <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;126&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;598&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;19&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;}]"> 2.83 </a></td>
    <td>0.83</td>

    <td>
        <a href="http://localhost:8000/competency/user/development/1551" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
    </td>
</tr>
</tbody>
</table>
</div>
<div class="tab-pane" id="business">
    <table class="table table-bordered table-striped table-advance table-hover">
        <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Kompetensi</th>
            <th>RCL</th>
            <th>CCL</th>
            <th>GAP</th>
            <th>Detail</th>
        </tr>
        </thead>
        <tbody>
        <tr class="warning">
            <td>KF.RBW.02</td>
            <td>Implementasi Kebijakan</td>
            <td>4</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.67 </a></td>
            <td>-0.33</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1578" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr class="danger">
            <td>KF.RBW.03</td>
            <td>Monitoring dan Evaluasi Kebijakan</td>
            <td>4</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.33 </a></td>
            <td>-0.67</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1579" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr class="warning">
            <td>KF.RBW.05</td>
            <td>Teknik Koordinasi</td>
            <td>4</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;4&quot;}]"> 3.67 </a></td>
            <td>-0.33</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1580" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr>
            <td>KF.RBW.06</td>
            <td>Analisis Data</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3 </a></td>
            <td>0</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1581" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr>
            <td>KF.RBW.07</td>
            <td>Penyusunan Pelaporan</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;}]"> 3.33 </a></td>
            <td>0.33</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1582" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr class="danger">
            <td>KF.RBW.11</td>
            <td>Pengeloaan Sosialisasi</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;2&quot;}]"> 2.33 </a></td>
            <td>-0.67</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1583" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr>
            <td>KF.RBW.12</td>
            <td>Reformasi Birokrasi</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;5&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;5&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;5&quot;}]"> 4.33 </a></td>
            <td>1.33</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1584" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr>
            <td>KF.RBW.13</td>
            <td>Manajemen Perubahan</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;4&quot;}]"> 3.33 </a></td>
            <td>0.33</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1585" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr class="warning">
            <td>KF.RBW.14</td>
            <td>Pengawasan Pemerintahan</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;3&quot;}]"> 2.67 </a></td>
            <td>-0.33</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1586" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        <tr>
            <td>KF.RBW.15</td>
            <td>Manajemen Kinerja Institusi</td>
            <td>3</td>
            <td><a class="modalize" href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-value="[{&quot;rater_id&quot;:&quot;assessor&quot;,&quot;level&quot;:&quot;2&quot;},{&quot;rater_id&quot;:&quot;444&quot;,&quot;level&quot;:&quot;4&quot;},{&quot;rater_id&quot;:&quot;540&quot;,&quot;level&quot;:&quot;3&quot;},{&quot;rater_id&quot;:&quot;124&quot;,&quot;level&quot;:&quot;2&quot;}]"> 3 </a></td>
            <td>0</td>

            <td>
                <a href="http://localhost:8000/competency/user/development/1587" class="btn btn-primary btn-xs"><i class="fa fa-gears"></i></a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

</div>
</section>
</div>
</div>

@stop

@section('customjs')
<script src="{{ asset('assets/jquery-knob/js/jquery.knob.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/select2/select2.js') }}"></script>
<script type="text/javascript">
    $(".knob").knob();
    $("#autocomplete").select2();
    $(".modalize").on('click', function(e){

//        alert($(this).data('value'));
        var table ="<table class='table table-bordered table-striped table-advance table-hover'><thead><tr><th>Rater Id</th><th>Value</th></tr></thead><tbody>";
        $.each($(this).data('value'), function() {
            table = table+"<tr>";
            $.each(this, function(k, v) {
                table = table+"<td>"+v+"</td>";
            });
            table = table+"</tr>";
        });
        table = table+"</tbody></table>";
        console.log(table);

        $("#modal-body").html(table);
    });
</script>
@stop
