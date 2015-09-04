<?php foreach ($dataProfile as $profiles): ?>
<div style="page-break-after:always">
    <h2>Kompetensi <?php echo $profiles->competencyDictionary->title." ( ".$profiles->competency_dictionary->code." ) "; ?></h2>
    <h3><?php echo $profiles->competency_dictionary->description;?></h3>
    <h4>Jabatan : <?php echo $jabatanTerpilih->nama_lengkap;?></h4>

    <table border="1">
        <?php foreach($profiles->competency_dictionary->level as $level): ?>
            <tr>
                <td width="10%">
                </td>
                <td>
                    <b><?php echo $level->title; ?></b>
                    <br/>
                    <?php echo $level->description; ?>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <br/>
    <h4>Evidence</h4>
    <table border="1" width="100%">
        <tr>
            <td height="150px" width="100%">

            </td>
        </tr>
    </table>
</div>
<?php endforeach;?>