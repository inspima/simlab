<thead>
    <tr>
        <th>No</th>
        <th>Waktu Pembayaran</th>
        <th>Total Biaya</th>
        <th>Potongan Diskon</th>
        <th>Total Dibayar</th>
        <th>Keterangan</th>
        <th>Tgl Jatuh Tempo</th>
        <th>Status Pembayaran</th>
        <th>Via Pembayaran</th>
        <th>Detail Biaya</th>
        <th>-</th>
    </tr>
</thead>
<tbody>
    <?php
    $no = 1;
    $total_pembayaran = 0;
    foreach ($data_pembayaran as $pem) {
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $pem['waktu_pembayaran'] ?></td>
            <td style="text-align: right"><?php echo number_format($pem['total_biaya']) ?></td>
            <td style="text-align: right"><?php echo number_format($pem['potongan']) ?></td>
            <td style="text-align: right"><?php echo number_format($pem['total_dibayar']) ?></td>
            <td><?php echo $pem['keterangan'] ?></td>
            <td><?php echo $pem['tgl_jatuh_tempo'] ?></td>
            <td style="text-align: center">
                <?php
                if ($pem['status_pembayaran'] == '1') {
                    ?>
                    <button class="btn btn-info">Registrasi</button>
                    <?php
                } else if ($pem['status_pembayaran'] == '2') {
                    ?>
                    <button class="btn btn-success">Pelunasan</button>
                    <?php
                }
                ?>
            </td>
            <td style="text-align: center">
                <?php
                if ($pem['via_pembayaran'] == '1') {
                    ?>
                    <button class="btn btn-default">Tunai</button>
                    <?php
                } else if ($pem['via_pembayaran'] == '2') {
                    ?>
                    <button class="btn btn-default">EDC</button>
                    <?php
                } else if ($pem['via_pembayaran'] == '3') {
                    ?>
                    <button class="btn btn-default">Transfer Rekening Giro</button>
                    <?php
                }
                ?>
            </td>
            <td style="text-align: right">
                <?php
                foreach ($pem['detail'] as $dp) {
                    echo $dp['nama_biaya'] . ' Rp. ' . number_format($dp['besar_biaya']) . "<br/>";
                }
                ?>
            </td>
            <td style="text-align: center">
                <a class="btn pembayaran-penyewaan-delete-button" title="Delete" id="<?php echo $pem['id_pembayaran_penyewaan'] ?>" ><i class="icon-remove"></i></a>
                <?php
                if (in_array($pem['status_pembayaran'], array(1, 2))) {
                    ?>
                    <a class="btn" title="Cetak Bukti Bayar" href="<?php echo Yii::app()->createUrl('registrasi/cetak/bayar_penyewaan?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" ><i class="icon-print"></i></a>
                    <?php
                }
                ?>
            </td>
        </tr>
        <?php
        $no++;
        $total_pembayaran+=$pem['total_dibayar'];
    }
    ?>
    <tr>
        <td colspan="4" style="text-align: center">
            <b>TOTAL</b>
        </td>
        <td style="text-align: right"><?php echo number_format($total_pembayaran) ?></td>
        <td colspan="6"></td>
    </tr>
</tbody>
<script type="text/javascript">
    $('#pembayaran-penyewaan-table tbody').on('click', '.pembayaran-penyewaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deletePembayaranPasienPenyewaan/?id_registrasi=' . $id_registrasi . '&no_registrasi=' . $no_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#pembayaran-penyewaan-table').html(data);
                }
            });
    });


</script>