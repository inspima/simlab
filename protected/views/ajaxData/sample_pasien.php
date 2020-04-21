<thead>
    <tr>
        <th>No</th>
        <th>Kode Sample</th>
        <th>Nama Sample</th>
        <th>Waktu Masuk</th>
        <th>Keterangan Sample</th>
        <th>-</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 1;
    foreach ($data_sample_pasien as $dp) {
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $dp['kode_sample'] ?></td>
            <td><?php echo $dp['nama_sample'] ?></td>
            <td><?php echo $dp['waktu_masuk'] ?></td>
            <td><?php echo $dp['keterangan_sample'] ?></td>
            <td style="text-align: center">
                <a class="btn sample-pemeriksaan-delete-button" title="Delete" id="<?php echo $dp['id_registrasi_pasien_sample'] ?>" ><i class="icon-remove"></i></a>
            </td>
        </tr>
        <?php
        $no++;
    }
    ?>
</tbody>
<script type="text/javascript">
    $('#sample-pemeriksaan-table tbody').on('click', '.sample-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deleteSamplePasienPemeriksaan/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#sample-pemeriksaan-table').html(data);
                }
            });
    });
</script>