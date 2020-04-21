<div class="accordion-inner">


    <?php if (Yii::app()->user->hasFlash('success_pembayaran')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_pembayaran'); ?>
        </div>
    <?php endif; ?>

    <h2>Data Pembayaran</h2>
    <hr/>

    <a href="#modal-pembayaran-fasilitas" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Pembayaran</a>
    <div id="modal-pembayaran-fasilitas" class="modal hide fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="modal-pembayaran-fasilitasLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="modal-pembayaran-fasilitasLabel">Form Pembayaran Fasilitas</h3>
        </div>
        <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
            <fieldset>
                <div class="modal-body">
                    <div class="control-group">											
                        <label class="control-label" for="no_registrasi">No.Registrasi</label>
                        <div class="controls">
                            <input type="hidden" class="span3" name="no_kwitansi_pembayaran" value="<?php echo $no_kwitansi_auto ?>">
                            <input type="text" class="span3" name="no_registrasi" readonly="" value="<?php echo empty($data_registrasi['no_kwitansi_daftar']) ? $no_daftar_auto : $data_registrasi['no_kwitansi_daftar'] ?>">
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->
                    <div class="control-group">											
                        <label class="control-label" for="waktu_pembayaran">Waktu Pembayaran</label>
                        <div class="controls">
                            <div id="waktu_pembayaran"  class="input-append">
                                <input class="span3 m-wrap" name="waktu_pembayaran" type="text"  value="<?php echo date('Y-m-d H:i:s') ?>"  type="text"/>
                                <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div> <!-- /control-group -->
                    <div class="control-group">
                        <i class="alert alert-info">Pilih Status Pembayaran agar terlihat item biaya </i>                    
                    </div>
                    <div class="control-group">											
                        <label class="control-label" for="status_pembayaran">Status Pembayaran</label>
                        <div style="width: 50%">
                            <div class="controls">
                                <select name="status_pembayaran" id="status_pembayaran" class=""  data-placeholder="Pilih Status Pembayaran..." tabindex="2">
                                    <option value="0">---</option>
                                    <option value="1">Registrasi</option>
                                    <option value="2">Pelunasan</option>
                                </select>
                            </div> <!-- /controls -->				
                        </div>
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="">Biaya yang Akan Dibayar</label>
                        <div class="controls">
                            <div id="biaya_registrasi_item" style="display: none">
                                <table style="width: 100%">
                                    <?php
                                    if (!empty($penyewaan_biaya)) {
                                        ?>
                                        <tr>
                                            <td style="text-align: left">
                                                <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_1" value="1"/>
                                                <input type="hidden" name="nama_biaya_1" value="Bench Fee"/>
                                                <label style="display: inline-block;margin: auto 0px">Bench Fee</label>
                                            </td>
                                            <td style="text-align: left">
                                                <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_1" value="<?php echo (count($data_anggota_registrasi) + 1) * $penyewaan_biaya['besar_biaya'] ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">
                                                <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_2" value="1"/>
                                                <input type="hidden" name="nama_biaya_2" value="Deposit"/>
                                                <label style="display: inline-block;margin: auto 0px">Deposit</label>
                                            </td>
                                            <td style="text-align: left">
                                                <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_2" value="<?php echo number_format($penyewaan_biaya['besar_deposit'], 0, '', '') ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">
                                                <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_3" value="1"/>
                                                <input type="hidden" name="nama_biaya_3" value="Administrasi"/>
                                                <label style="display: inline-block;margin: auto 0px">Biaya Administrasi</label>
                                            </td>
                                            <td style="text-align: left">
                                                <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_3" value="<?php echo number_format($penyewaan_biaya['besar_biaya_administrasi'], 0, '', '') ?>">
                                            </td>
                                        </tr>
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td style="text-align: left">
                                                <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_1" value="1"/>
                                                <input type="hidden" name="nama_biaya_1" value="Bench Fee"/>
                                                <label style="display: inline-block;margin: auto 0px">Bench Fee</label>
                                            </td>
                                            <td style="text-align: left">
                                                <input type="text" class="span2 biaya_detail"  style="text-align: right"  style="text-align: right" name="besar_biaya_1" value="0"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">
                                                <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_2" value="1"/>
                                                <input type="hidden" name="nama_biaya_2" value="Deposit"/>
                                                <label style="display: inline-block;margin: auto 0px">Deposit</label>
                                            </td>
                                            <td style="text-align: left">
                                                <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_2" value="0">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align: left">
                                                <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_3" value="1"/>
                                                <input type="hidden" name="nama_biaya_3" value="Administrasi"/>
                                                <label style="display: inline-block;margin: auto 0px">Biaya Administrasi</label>
                                            </td>
                                            <td style="text-align: left">
                                                <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_3" value="0">
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </table>
                            </div>
                            <div id="biaya_pelunasan_item" style="display: none">
                                <table style="width: 100%">
                                    <tr>
                                        <td style="text-align: left">
                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_4" value="1"/>
                                            <input type="hidden" name="nama_biaya_4" value="Penyusutan Alat"/>
                                            <label style="display: inline-block;margin: auto 0px">Biaya Penyusutan Alat</label>
                                        </td>
                                        <td style="text-align: left">
                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_4" value="<?php echo "0"; /* number_format($penyewaan_biaya[''], 0, '', '') */ ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">
                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_5" value="1"/>
                                            <input type="hidden" name="nama_biaya_5" value="Sewa Kandang"/>
                                            <label style="display: inline-block;margin: auto 0px">Sewa Kandang Coba</label>
                                        </td>
                                        <td style="text-align: left">
                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_5" value="<?php echo "0"; /* number_format($penyewaan_biaya[''], 0, '', '') */ ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">
                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_6" value="1"/>
                                            <input type="hidden" name="nama_biaya_6" value="Bahan Habis Pakai"/>
                                            <label style="display: inline-block;margin: auto 0px">Bahan Habis Pakai Lab.</label>
                                        </td>
                                        <td style="text-align: left">
                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_6" value="<?php echo "0"; /* number_format($penyewaan_biaya[''], 0, '', '') */ ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">
                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_7" value="1"/>
                                            <input type="hidden" name="nama_biaya_7" value="Jasa Konsultan"/>
                                            <label style="display: inline-block;margin: auto 0px">Jasa Konsultan</label>
                                        </td>
                                        <td style="text-align: left">
                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_7" value="<?php echo "0"; /* number_format($penyewaan_biaya[''], 0, '', '') */ ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">
                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_8" value="1"/>
                                            <input type="hidden" name="nama_biaya_8" value="Jasa Teknisi"/>
                                            <label style="display: inline-block;margin: auto 0px">Jasa Teknisi</label>
                                        </td>
                                        <td style="text-align: left">
                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_8" value="<?php echo "0"; /* number_format($penyewaan_biaya[''], 0, '', '') */ ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: left">
                                            <input style="display: inline-block;margin: auto 0px" type="checkbox" class="check_biaya_detail" name="check_biaya_9" value="1"/>
                                            <input type="hidden" name="nama_biaya_9" value="Pemakaian Fasilitas"/>
                                            <label style="display: inline-block;margin: auto 0px">Pemakaian Fasilitas</label>
                                        </td>
                                        <td style="text-align: left">
                                            <input type="text" class="span2 biaya_detail"  style="text-align: right" name="besar_biaya_9" value="<?php echo number_format($jumlah_biaya_fasilitas, 0, '', '') ?>">
                                        </td>
                                    </tr>

                                </table>
                            </div>

                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="total_biaya">Total Biaya</label>
                        <div class="controls">
                            <input type="text" id="total_biaya" class="span3 validate[required]" name="total_biaya" value="">
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="potongan">Potongan/Diskon</label>
                        <div class="controls">
                            <input class="validate[required]"  id="potongan"  name="potongan" id="appendedPrependedInput" type="text" value="0">
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="total_dibayar">Total Dibayar</label>
                        <div class="controls">
                            <input type="text" id="total_dibayar" class="span3 validate[required]" name="total_dibayar" value="">
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->


                    <div class="control-group">											
                        <label class="control-label" for="via_pembayaran">Via Pembayaran</label>
                        <div class="controls">
                            <select name="via_pembayaran" class="span3">
                                <option value="1">Tunai</option>
                                <option value="2">Via Mesin EDC</option>
                                <option value="3">Transfer Rekening Giro</option>
                            </select>
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->


                    <div class="control-group">											
                        <label class="control-label" for="tgl_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        <div class="controls">
                            <input type="text" class="span2" name="tgl_jatuh_tempo" id="tgl_jatuh_tempo" >
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="keterangan">Keterangan </label>
                        <div class="controls">
                            <textarea name="keterangan"  style="resize: none;height:80px" class="span3"></textarea>
                        </div> <!-- /controls -->
                    </div> <!-- /control-group -->
                </div>
                <div class="modal-footer">

                    <input type="hidden" name="mode" value="pembayaran"/>
                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                    <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                    <button type="submit" class="btn btn-primary">Tambah Pembayaran</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>


                <br/>


            </fieldset>
        </form>


    </div>
    <table id="pembayaran-penyewaan-table" class="table table-striped table-bordered">
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
                            <a class="btn" title="Cetak Bukti Bayar" href="<?php echo Yii::app()->createUrl('registrasi/cetak/bayar_penyewaan?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi . '&id_pembayaran=' . $pem['id_pembayaran_penyewaan']); ?>" target="_blank" ><i class="icon-print"></i></a>
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
    </table>
    <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
        <fieldset>


            <br/>

            <div class="form-actions">
                <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/penyewaan_lembar_pemohon?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Lembar Pemohon</a>
                <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/penyewaan_lembar_lab?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Lembar Lab</a>
                <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/penyewaan_lembar_registrasi?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Lembar Registrasi</a>
            </div> <!-- /form-actions -->
        </fieldset>
    </form>
</div>