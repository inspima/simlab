<thead>
    <tr>
        <th>No</th>
        <th>Nama Bahan</th>
        <th>Jumlah Bahan</th>
        <th>Tarif Satuan</th>
        <th>Harga Total</th>
        <th>-</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 1;
    foreach ($data_bahan_pasien as $dp) {
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $dp['nama_bahan'] ?></td>
            <td><?php echo $dp['jumlah_bahan'] ?></td>
            <td style="text-align: right">Rp. <?php echo number_format($dp['harga_bahan']) ?></td>
            <td style="text-align: right">Rp. <?php echo number_format($dp['harga_bahan'] * $dp['jumlah_bahan']) ?></td>
            <td style="text-align: center">
                <a class="btn bahan-pemeriksaan-delete-button" title="Delete" id="<?php echo $dp['id_bahan_pasien'] ?>" ><i class="icon-remove"></i></a>
            </td>
        </tr>
        <?php
        $no++;
    }
    ?>
</tbody>
<script type="text/javascript">
    $('#bahan-pemeriksaan-table tbody').on('click', '.bahan-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deleteBahanPasien/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#bahan-pemeriksaan-table').html(data);
                }
            });
    });
</script>