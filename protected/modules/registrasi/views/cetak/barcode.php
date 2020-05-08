<style>
    table, th, td {
        border: none;
        border-collapse: collapse;
        padding: 10px
    }
    .bordered {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 10px
    }
</style>
<table  style="width: 100%;margin-top:0%" class="table-bordered ">
    <tr>
        <td style="text-align: center;font-size:1.3em;width:40%" >
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','',array()); ?><br/>
            <b style="text-align: center;font-size:1.3em;"><?=$data_registrasi['no_registrasi']?></b><br/>
            <b style="text-align: center;font-size:1.3em;"><?=strtoupper($data_registrasi['nama_pasien'])?></b><br/>
            <b><?=$data_registrasi['nama_instansi']?></b><br/>
            <b><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
        <td style="width:5%"></td>
        <td style="text-align: center;font-size:1.3em;width:40%" >
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','',array()); ?><br/>
            <b style="text-align: center;font-size:1.3em;"><?=$data_registrasi['no_registrasi']?></b><br/>
            <b style="text-align: center;font-size:1.3em;"><?=strtoupper($data_registrasi['nama_pasien'])?></b><br/>
            <b><?=$data_registrasi['nama_instansi']?></b><br/>
            <b><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
    </tr>
</table>