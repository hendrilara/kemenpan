<?php foreach ($dataProfile as $profile): ?>
    <table class="table">
        <thead>
        <tr>
            <th colspan="2"> Kode : <?php echo $dictionary->code ;?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Kompetensi</td>
            <td><?php echo $dictionary->name ;?></td>
        </tr>
        <tr>
            <td>Definisi</td>
            <td><?php echo $dictionary->description ;?></td>
        </tr>
        <!--        <tr>-->
        <!--            <td>Kompetensi</td>-->
        <!--            <td>{{ $dictionary->name }}</td>-->
        <!--        </tr>-->
        </tbody>
    </table>
    <h3>Skala</h3>
    <table class="table">
        <thead>
        <tr>
            <th>Penjelasan Indikator Perilaku Pemegang Jabatan</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($dictionary->level as $level): ?>
            <tr>
                <td>
                    <strong><?php $level->title ;?></strong> <br>
                    <?php echo $level->description ;?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>
</body>