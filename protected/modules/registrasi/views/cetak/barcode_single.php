<style>
    table, th, td {
        border: none;
        border-collapse: collapse;
        padding: 3px
    }
    .bordered {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 0px
    }
</style>
<table  style="width: 100%;margin-top:0%" class="table-bordered ">
    <tr>
        <td style="text-align: center;width:49%" >
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','New Barcode',array('width'=>'100%','height'=>'40px')); ?><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['no_registrasi']?></b><br/>
            <b style="font-size:0.7em"><?=strtoupper($data_registrasi['nama_pasien'])?></b><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['nama_instansi']?></b><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
        <td style="width:2%"></td>
        <td style="text-align: center;width:49%" >
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','New Barcode',array('width'=>'100%','height'=>'40px')); ?><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['no_registrasi']?></b><br/>
            <b style="font-size:0.7em"><?=strtoupper($data_registrasi['nama_pasien'])?></b><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['nama_instansi']?></b><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b style="font-size:0.6em"><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
    </tr>
</table>