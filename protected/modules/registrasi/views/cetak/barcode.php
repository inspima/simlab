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
<table  style="width: 95%;margin-left: 5%;" class="table-bordered ">
    <tr>
        <td style="text-align: center;font-size:1.3em" class="bordered">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','',array()); ?><br/>
            <b><?=$data_registrasi['no_registrasi']?></b><br/>
            <b><?=$data_registrasi['nama_pasien']?></b><br/>
            <b><?=$data_registrasi['nama_instansi']?></b><br/>
            <b><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
        <td style="width:5%"></td>
        <td style="text-align: center;font-size:1.3em" class="bordered">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','',array()); ?><br/>
            <b><?=$data_registrasi['no_registrasi']?></b><br/>
            <b><?=$data_registrasi['nama_pasien']?></b><br/>
            <b><?=$data_registrasi['nama_instansi']?></b><br/>
            <b><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
    </tr>
    <tr>
        <td colspan="2"></td>
    </tr>
    <tr>
        <td style="text-align: center;font-size:1.3em" class="bordered">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','',array()); ?><br/>
            <b><?=$data_registrasi['no_registrasi']?></b><br/>
            <b><?=$data_registrasi['nama_pasien']?></b><br/>
            <b><?=$data_registrasi['nama_instansi']?></b><br/>
            <b><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
        <td style="width:5%"></td>
        <td style="text-align: center;font-size:1.3em" class="bordered">
            <?php echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$no_registrasi.'.jpg','',array()); ?><br/>
            <b><?=$data_registrasi['no_registrasi']?></b><br/>
            <b><?=$data_registrasi['nama_pasien']?></b><br/>
            <b><?=$data_registrasi['nama_instansi']?></b><br/>
            <b><?=$data_registrasi['jenis_kelamin']==1?"Laki-laki":"Perempuan"?> / <?=$data_registrasi['umur']?> Tahun</b><br/>
            <b><?=$data_registrasi['waktu_registrasi']?></b><br/>
        </td>
    </tr>
</table>