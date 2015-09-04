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
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th rowspan="2">no</th>
                        <th rowspan="2">Kriteria evaluasi</th>
                        <th colspan="5">respon</th>
                    </tr>
                    <tr>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="7">A. Penyampaian Materi</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Tujuan diklat disampaikan dengan jelas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Topik yang dibahas relevan</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Setiap sesi Diklat menyampaikan sasaran dengan jelas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Terdapat kesempatan yang mencukupi bagi peserta untuk terlibat secara interaktif</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Materi diklat berguna bagi bidang pekerjaan saya</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Sebagian besar pertanyaan/permasalahan saya telah terjawab dalam Diklat ini</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Durasi Diklat mencukupi bagi penyelesaian seluruh bahasan materi</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Diklat dimulai dan diakhiri tepat waktu</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Diktat/bahan ajar Diklat sangat membantu saya dalam memahami</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td colspan="7">B. Nara Sumber</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Nara Sumber menguasai materi yang dibahas</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nara Sumber mempersiapkan dengan baik tiap sesi diklat</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Nara Sumber mendorong terciptanya partisipasi aktif peserta</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nara Sumber menjawab pertanyaan dengan jelas dan lengkap</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Nara Sumber menghormati peserta</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    <tr>
                        <td colspan="7">C. Fasilitas Diklat</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Nara Sumber menghormati peserta</td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                        <td><input type="checkbox"></td>
                    </tr>
                    </tbody>
                </table>
                {{ Form::close() }}

            </div>
        </div>
        <!--widget end-->
    </div>
</div>
@stop