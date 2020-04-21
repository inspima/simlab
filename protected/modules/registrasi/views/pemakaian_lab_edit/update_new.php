<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Registrasi Pemakaian Lab - Update</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content"> 
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('registrasi/pemakaian_lab_edit/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <div class="accordion" id="accordion-pemeriksaan">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-satu">
                                REGISTRASI
                            </a>
                        </div>
                        <div id="collapse-satu" class="accordion-body collapse <?php if ($step == 1) echo 'in'; ?>">
                            <?php $this->renderPartial('_tab_registrasi', array('data_registrasi' => $data_registrasi, 'data_dokumen' => $data_dokumen, 'data_pasien_tipe' => $data_pasien_tipe)) ?>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-dua">
                                ANGGOTA DAN BIAYA REGISTRASI
                            </a>
                        </div>
                        <div id="collapse-dua" class="accordion-body collapse <?php if ($step == 2) echo 'in'; ?>">
                            <?php $this->renderPartial('_tab_anggota', array('id_registrasi' => $id_registrasi, 'no_registrasi' => $no_registrasi, 'data_anggota_registrasi' => $data_anggota_registrasi, 'data_penyewaan_biaya' => $data_penyewaan_biaya, 'id_registrasi_penyewaan_biaya' => $id_registrasi_penyewaan_biaya)) ?>
                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-tiga">
                                FASILITAS
                            </a>
                        </div>
                        <div id="collapse-tiga" class="accordion-body collapse <?php if ($step == 3) echo 'in'; ?>">
                            <?php $this->renderPartial('_tab_fasilitas', array('id_registrasi' => $id_registrasi, 'no_registrasi' => $no_registrasi, 'data_fasilitas_sewa' => $data_fasilitas_sewa, 'data_registrasi_fasilitas' => $data_registrasi_fasilitas)) ?>

                        </div>
                    </div>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-pemeriksaan" href="#collapse-empat">
                                PEMBAYARAN
                            </a>
                        </div>
                        <div id="collapse-empat" class="accordion-body collapse <?php if ($step == 4) echo 'in'; ?>">
                            <?php $this->renderPartial('_tab_pembayaran', array('id_registrasi' => $id_registrasi,'no_daftar_auto'=>$no_daftar_auto, 'no_registrasi' => $no_registrasi, 'no_kwitansi_auto' => $no_kwitansi_auto, 'data_registrasi' => $data_registrasi, 'penyewaan_biaya' => $penyewaan_biaya, 'data_anggota_registrasi' => $data_anggota_registrasi, 'data_pembayaran' => $data_pembayaran, 'jumlah_biaya_fasilitas' => $jumlah_biaya_fasilitas)) ?>
                        </div>
                    </div>
                </div>
            </div><!-- /widget-content -->

        </div>  <!-- /widget -->	
    </div> <!-- /spa12 -->
</div><!-- /row -->
<?php
include 'plugins.php';
?>
<script type="text/javascript">
    $('#pembayaran-penyewaan-table tbody').on('click', '.pembayaran-penyewaan-delete-button', function () {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deletePembayaranPasienPenyewaan/?id_registrasi=' . $id_registrasi . '&no_registrasi=' . $no_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function (data) {
                    window.location = window.location.href.split("#")[0];
                }
            });
    });
</script>
<script type="text/javascript">
    $('#potongan').keyup(function () {
        $('#total_dibayar').val($('#total_biaya').val() - $(this).val())
    });
    $('#tanggal_lahir,#tgl_order_masuk,#tgl_order_warning,#tgl_surat_permohonan,#tgl_surat_daftar,#tgl_jatuh_tempo,#tgl_selesai').datepicker({
        format: 'yyyy-mm-dd'
    });
    $('#jumlah_pemakaian').keyup(function () {
        var id_barang_sewa_tarif = $('#fasilitas_sewa').val();
        var jumlah = $(this).val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBarangSewaTarif/') ?>',
            data: 'id_barang_sewa_tarif=' + id_barang_sewa_tarif,
            type: 'post',
            success: function (data) {
                var barang_sewa_tarif = $.parseJSON(data);
                $('#besar_tarif_sewa').val(barang_sewa_tarif.tarif_sewa * jumlah);
            }
        });

    });

    $('#fasilitas_sewa').change(function () {
        var id_barang_sewa_tarif = $(this).val();
        var jumlah = $('#jumlah_pemakaian').val();
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('AjaxData/getBarangSewaTarif/') ?>',
            data: 'id_barang_sewa_tarif=' + id_barang_sewa_tarif,
            type: 'post',
            success: function (data) {
                var barang_sewa_tarif = $.parseJSON(data);
                $('#besar_tarif_sewa').val(barang_sewa_tarif.tarif_sewa * jumlah);
            }
        });

    });
    $('#tanggal_lahir').datepicker().on('changeDate', function (ev) {
        $('#umur').val(getAge($(this).val()));
    });
    $('#waktu_registrasi, #waktu_pembayaran').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'pt-BR'
    });
    $('#tgl_awal_sewa, #tgl_akhir_sewa').datetimepicker({
        format: 'yyyy-MM-dd',
        language: 'pt-BR'
    });
    var total_pembayaran_detail = 0;

    $(".check_biaya_detail").click(function () {
        var total_pembayaran_detail = 0;
        $(".biaya_detail").each(function (index, value) {
            if ($("input[name='check_biaya_" + (index + 1) + "']").is(':checked')) {
                total_pembayaran_detail += parseInt($("input[name='besar_biaya_" + (index + 1) + "']").val());
                $('#total_biaya').val(total_pembayaran_detail);
                $('#total_dibayar').val(total_pembayaran_detail);
            }
        });
    });

    $('#status_pembayaran').change(function () {
        var status_pembayaran = $(this).val();
        if (status_pembayaran == 1) {
            $('#biaya_registrasi_item').fadeIn();
            $('#biaya_pelunasan_item').fadeOut();
        } else if (status_pembayaran == 2) {
            $('#biaya_pelunasan_item').fadeIn();
            $('#biaya_registrasi_item').fadeOut();
        }
    });
</script>
