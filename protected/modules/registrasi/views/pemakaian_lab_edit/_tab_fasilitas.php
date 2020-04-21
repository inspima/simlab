<div class="accordion-inner">
    <?php if (Yii::app()->user->hasFlash('success_penyewaan_biaya')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_penyewaan_biaya'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('success_tambah_fasilitas')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_tambah_fasilitas'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('success_hapus_fasilitas')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_hapus_fasilitas'); ?>
        </div>
    <?php endif; ?>


    <h2>Data Pemakaian Fasilitas</h2>
    <hr/>

    <a href="#modal-barang-fasilitas" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Pemakaian</a>
    <div id="modal-barang-fasilitas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-barang-fasilitasLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="modal-barang-fasilitasLabel">Form Pemakaian Fasilitas</h3>
        </div>
        <form class="form-horizontal form-validation" method="post" style="margin: 10px 10px 10px 10px">
            <fieldset>
                <div class="modal-body">
                    <div class="control-group">											
                        <label class="control-label" for="fasilitas">Data Fasilitas</label>
                        <div class="controls">
                            <div style="width:90%">
                                <select name="fasilitas" id="fasilitas_sewa" class="chosen" tabindex="2">
                                    <?php
                                    foreach ($data_fasilitas_sewa as $df):
                                        ?>
                                        <option value="<?php echo $df['id_barang_sewa_tarif'] ?>" ><?php echo $df['nama_barang'] . ', per ' . $df['jumlah_satuan_sewa'] . ' ' . $df['nama_satuan'] . ' ' . $df['keterangan_tarif'] . ', Tarif : Rp. ' . number_format($df['tarif_sewa']) ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="tgl_awal_sewa">Tanggal Awal Sewa</label>
                        <div class="controls">
                            <div id="tgl_awal_sewa"  class="input-append">
                                <input class="span3 m-wrap" name="tgl_awal_sewa" type="text"  value=""  type="text"/>
                                <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="tgl_akhir_sewa">Tanggal Akhir Sewa</label>
                        <div class="controls">
                            <div id="tgl_akhir_sewa"  class="input-append">
                                <input class="span3 m-wrap" name="tgl_akhir_sewa" type="text"  value=""  type="text"/>
                                <span class="add-on"> <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                            </div>
                        </div>
                    </div> <!-- /control-group -->                          

                    <div class="control-group">											
                        <label class="control-label" for="jumlah_pemakaian">Lama/Jumlah Pemakaian</label>
                        <div class="controls">
                            <input type="text" id="jumlah_pemakaian" class="span3 validate[required]" name="jumlah_pemakaian" value="1">
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="tarif_sewa">Besar Tarif</label>
                        <div class="controls">
                            <input type="text" id="besar_tarif_sewa" class="span3 validate[required]" name="tarif_sewa" value="">
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

                    <input type="hidden" name="mode" value="tambah-fasilitas"/>
                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                    <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                    <button type="submit" class="btn btn-primary">Tambah Pemakaian Fasilitas</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>


                <br/>


            </fieldset>
        </form>


    </div>
    <table id="fasilitas-penyewaan-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Fasilitas</th>
                <th>Waktu Pemakaian</th>
                <th>Lama/Jumlah Pemakaian</th>
                <th>Tarif Pemakaian</th>
                <th>Keterangan</th>
                <th>-</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $total_fasilitas = 0;
            foreach ($data_registrasi_fasilitas as $dr) {
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $dr['nama_barang'] ?></td>
                    <td style="text-align: center;width: 200px">
                        Mulai : <?php echo $dr['tgl_awal_penyewaan']; ?><br/>
                        Akhir : <?php echo $dr['tgl_akhir_penyewaan']; ?><br/>
                    </td>
                    <td style="text-align: right"><?php echo $dr['lama_sewa']; ?></td>
                    <td style="text-align: right"><?php echo number_format($dr['besar_tarif']) ?></td>
                    <td><?php echo $dr['keterangan_penyewaan'] ?></td>
                    <td style="text-align: center">
                        <form method="post">
                            <input type="hidden" name="mode" value="hapus-fasilitas"/>
                            <input type="hidden" name="id_pasien_penyewaan" value="<?php echo $dr['id_pasien_penyewaan_barang'] ?>"/>
                            <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                            <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                            <button type="submit" class="btn"><i class="icon-remove"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                $no++;
                $total_fasilitas+=$dr['besar_tarif'];
            }
            ?>
            <tr>
                <td colspan="4" style="text-align: center">
                    <b>TOTAL</b>
                </td>
                <td style="text-align: right"><?php echo number_format($total_fasilitas) ?></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>
    <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
        <fieldset>

            <br/>

            <div class="form-actions">
                <a class="btn" href="<?php echo Yii::app()->createUrl('registrasi/cetak/pemakaian_fasilitas?reg=' . $id_registrasi . '&no_reg=' . $no_registrasi); ?>" target="_blank" title="Cetak" id="" ><i class="icon-print"></i> Cetak Form Pemakaian</a>
            </div> <!-- /form-actions -->
        </fieldset>
    </form>

</div> <!-- /controls -->	