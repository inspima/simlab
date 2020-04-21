
<fieldset>
    <table id="pasien-pemeriksaan-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Pengujian</th>
                <th>Tarif Pengujian</th>
                <th>Sample & Bahan</th>
                <th>Tgl Perkiraan Selesai</th>
                <th>Besar Biaya</th>
                <th>Total </th>
                <th>-</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_pasien_pemeriksaan = 0;
            foreach ($data_pasien_pemeriksaan as $dpp) {
                $total_tarif_pemeriksaan = 0;
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td>(<?php echo $dpp['kode_pengujian'] ?>) <?php echo $dpp['nama_pengujian'] ?></td>
                    <td style="text-align: right">
                        <input type="text" style="width: 90%"  name="tp_pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['besar_tarif'] ?>"/>
                    </td>
                    <td style="width: 200px">
                        <div>
                            <select name="sample<?php echo $no ?>[]" class="chosen" multiple="" data-placeholder="Pilih Sample" tabindex="2">
                                <?php
                                $jumlah_pemeriksaan_sample = 0;
                                foreach ($dpp['data_sample'] as $d):
                                    if ($d['id_pemeriksaan_sample'] != '') {
                                        $jumlah_pemeriksaan_sample = $jumlah_pemeriksaan_sample + 1 * $d['jumlah_sample'];
                                    }
                                    ?>
                                    <option value="<?php echo $d['id_registrasi_pasien_sample'] ?>" <?php if ($d['id_pemeriksaan_sample'] != '') echo "selected"; ?>><?php echo $d['nama_sample'] . ' ' . $d['jumlah_sample'] . ' ' . ($d['keterangan_sample'] != '' ? ' [' . $d['keterangan_sample'] . ']' : '') ?></option>
                                    <?php
                                endforeach;
                                if ($jumlah_pemeriksaan_sample == 0) {
                                    $jumlah_pemeriksaan_sample = 1;
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td style="text-align: center">
                        <input type="text" style="width: 90%"  class="tgl_selesai" name="tgl_selesai_pasien_pemeriksaan<?php echo $no ?>" value=""/>
                    </td>
                    <td style="text-align: right">
                        <input type="text" style="text-align: right" readonly="" value="<?php echo number_format($dpp['besar_tarif'] * $jumlah_pemeriksaan_sample) ?>"/>
                    </td>
                    <td style="text-align: right">

                    </td>
                    <td style="text-align: center" rowspan="2">
                        <a class="btn pasien-pemeriksaan-delete-button" title="Delete" id="<?php echo $dpp['id_pasien_pemeriksaan'] ?>" ><i class="icon-remove"></i></a>
                        <input type="hidden" name="pasien_pemeriksaan_<?php echo $no ?>" value="<?php echo $dpp['id_pasien_pemeriksaan']; ?>"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right">
                        <b>Bahan Pengujian</b>
                    </td>
                    <td>
                        <div>
                            <select name="bahan<?php echo $no ?>[]" class="chosen" multiple="" data-placeholder="Pilih Bahan" tabindex="2">
                                <?php
                                $jumlah_pemeriksaan_bahan = 0;
                                $jumlah_tarif_bahan = 0;
                                foreach ($dpp['data_bahan'] as $d):
                                    if ($d['id_bahan_pengujian_pasien'] != '') {
                                        $jumlah_pemeriksaan_bahan = $jumlah_pemeriksaan_bahan + 1 * $d['jumlah_bahan'];
                                        $jumlah_tarif_bahan = $jumlah_tarif_bahan + $d['total_tarif'];
                                    }
                                    ?>
                                    <option value="<?php echo $d['id_bahan_pasien'] ?>" <?php if ($d['id_bahan_pengujian_pasien'] != '') echo "selected"; ?>><?php echo $d['nama_bahan'] . ($d['jumlah_bahan'] != '' ? ' [' . $d['jumlah_bahan'] . ']' : '') ?></option>
                                    <?php
                                endforeach;
                                if ($jumlah_pemeriksaan_bahan == 0) {
                                    $jumlah_pemeriksaan_bahan = 1;
                                }
                                $total_tarif_pemeriksaan = $dpp['besar_tarif'] * $jumlah_pemeriksaan_sample + $jumlah_tarif_bahan;
                                ?>
                            </select>
                        </div>
                    </td>
                    <td></td>
                    <td>
                        <input type="text" style="text-align: right" readonly="" value="<?php echo number_format($jumlah_tarif_bahan) ?>"/>
                    </td>
                    <td>
                        <input type="text" style="text-align: right" readonly="" value="<?php echo number_format($total_tarif_pemeriksaan) ?>"/>
                    </td>
                </tr>
                <?php
                $no++;
                $total_pasien_pemeriksaan += $total_tarif_pemeriksaan;
            }
            ?>
            <tr>
                <td colspan="6" style="text-align: center">
                    <b>TOTAL</b>
                </td>
                <td style="text-align: right">
                    <input type="text" style="text-align: right" style="width: 90%" readonly="" value="<?php echo number_format($total_pasien_pemeriksaan) ?>"/>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div class="form-actions">
        <input type="hidden" name="mode" value="pasien_pemeriksaan"/>
        <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
        <input type="hidden" name="jumlah_data" value="<?php echo $no ?>"/>
        <button type="submit" class="btn btn-primary">Save</button>
    </div> <!-- /form-actions -->
</fieldset>
<script type="text/javascript">
    $('#pasien-pemeriksaan-table tbody').on('click', '.pasien-pemeriksaan-delete-button', function() {
        var c = confirm("Apakah anda yakin menghapus data ini");
        if (c === true)
            $.ajax({
                type: 'post',
                url: '<?php echo Yii::app()->createUrl('AjaxData/deletePasienPemeriksan/?id_registrasi=' . $id_registrasi); ?>',
                data: 'id=' + $(this).attr('id'),
                success: function(data) {
                    $('#pasien-pemeriksaan-form').html(data);
                }
            });
    });
    $('.chosen').chosen();


</script>