<h2>Data Notifikasi</h2>
<hr/>
<div style="margin-bottom: 15px;" class="btn-group" role="group" aria-label="Group Notifikasi">
    <button class="btn btn-primary">Belum terbaca</button>    
    <a href="<?php echo Yii::app()->createUrl('setting/notifikasi/readed') ?>"  type="button" class="btn btn-secondary">Sudah terbaca</a>
    <a href="<?php echo Yii::app()->createUrl('setting/notifikasi/validasi') ?>"  type="button" class="btn btn-secondary">Validasi Hasil</a>
    <a href="<?php echo Yii::app()->createUrl('setting/notifikasi/input') ?>"  type="button" class="btn btn-secondary">Input Hasil</a>
    <a href="<?php echo Yii::app()->createUrl('setting/notifikasi/update') ?>"  type="button" class="btn btn-secondary">Perubahan Hasil</a>
</div>
<label class="alert alert-success">Klik tombol untuk memfilter notifikasi</label>
<div id="set-baca-loading" style="display: none;position: fixed;left:0;bottom: 20px;width: 100%;height: 20px;text-align: center">
    <img src="<?php echo Yii::app()->baseUrl; ?>/img/ajax-loader.gif"  style="width: 128px;height: 15px;margin: 0px auto;">
</div>
<?php
if (count($data_notifikasi) == 0) {
    ?>
    <div class="alert alert-danger"><strong>Mohon Maaf</strong> Data tidak ditemukan</div>
    <?php
}
foreach ($data_notifikasi as $d) {
    if ($d['batas_tampil'] < $d['hitung_tampil']) {
        // SET HILANG OTOMATIS
        Yii::app()->db->createCommand("update notifikasi set tampil='0' where id_notifikasi='{$d['id_notifikasi']}'")->query();
    }
    ?>
    <div class="alert alert-info">
        <strong>#<?php echo $d['id_notifikasi'] ?> <?php echo $d['judul_notifikasi'] ?> - <?php echo $d['waktu_notifikasi'] ?></strong>&nbsp;&nbsp;
        <?php
        if ($d['baca'] == 0) {
            ?>
            <span class="label label-warning">
                Belum terbaca 
            </span>
            <button style="float: right" class="btn btn-small btn-default set-baca" data-id="<?php echo $d['id_notifikasi'] ?>" href="<?php echo Yii::app()->createUrl($d['link_notifikasi']) ?>"><i class="icon-check"></i> tandai sudah terbaca</button> <br/>
            <?php
        } else {
            ?>
            <span class="label label-success">
                Sudah terbaca
            </span>

            <?php
        }
        ?>
        <br/>
        - <?php echo $d['isi_notifikasi'] ?> 
        <hr/>
        - Silahkan klik link untuk memproses 
        <?php
        if($d['judul_notifikasi']=='Validasi Hasil'){
            ?>
            ( <a target="_blank" style="font-weight: bold;color: red" href="<?php echo $d['link_notifikasi'] ?>">Cetak</a>) 
            / 
            ( <a target="_blank" style="font-weight: bold;color: red" href="<?php echo str_replace('hasil_pemeriksaan','hasil_pemeriksaan_new',$d['link_notifikasi']) ?>">Cetak & TTD)</a>)<br/>
            <?php
        }else{
            ?>
            ( <a target="_blank" style="font-weight: bold;color: red" href="<?php echo $d['link_notifikasi'] ?>">Proses</a>) <br/>
            <?php
        }
        ?>
        
        - Informasi ini akan hilang secara otomatis dalam waktu <b><?php echo $d['batas_tampil'] ?> Hari</b><br/>
    </div>
    <?php
}
?>
<?php
include 'plugins.php';
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.set-baca').click(function () {
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('setting/notifikasi/set_belum_terbaca') ?>',
                data: 'id=' + $(this).attr('data-id'),
                beforeSend: function () {
                    $('#set-baca-loading').show();
                },
                success: function (data) {
                    $('#set-baca-loading').hide();
                    $('#ajax-wrapper').html(data);
                }
            });
        })
    })
</script>