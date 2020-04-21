<div class="accordion-inner">

    <?php if (Yii::app()->user->hasFlash('success_registrasi')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_registrasi'); ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::app()->user->hasFlash('success_delete_anggota')): ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success_delete_anggota'); ?>
        </div>
    <?php endif; ?>


    <h2>Data Anggota</h2>
    <a href="#modal-anggota-fasilitas" role="button" style="margin: 10px 0px" class="btn" data-toggle="modal"><i class="icon-plus"></i> Tambah Anggota</a>
    <div id="modal-anggota-fasilitas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal-anggota-fasilitasLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="modal-anggota-fasilitasLabel">Form Anggota Pemakaian Fasilitas</h3>
        </div>
        <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
            <fieldset>
                <div class="modal-body">
                    <div class="control-group">											
                        <label class="control-label" for="nama_anggota">Nama Anggota</label>
                        <div class="controls">
                            <input type="text" class="span3 validate[required]" name="nama_anggota" value="">
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="judul">Judul Penelitian</label>
                        <div class="controls">
                            <textarea style="width: 90%;resize: none" name="judul"></textarea>
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->

                    <div class="control-group">											
                        <label class="control-label" for="status_anggota">Status Anggota</label>
                        <div class="controls">
                            <select name="status_anggota">
                                <option value="1">Mahasiswa</option>
                                <option value="2">Dosen</option>
                                <option value="3">Lainya</option>
                            </select>
                        </div> <!-- /controls -->				
                    </div> <!-- /control-group -->
                </div>
                <div class="modal-footer">

                    <input type="hidden" name="mode" value="tambah-anggota"/>
                    <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                    <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                    <button type="submit" class="btn btn-primary">Tambah Anggota</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                </div>


                <br/>


            </fieldset>
        </form>


    </div>
    <hr/>

    <table id="anggota-penyewaan-table" style="width: 80%" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul</th>
                <th>Status</th>
                <th>-</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data_anggota_registrasi as $da) {
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $da['nama_anggota'] ?></td>
                    <td><?php echo $da['judul_anggota'] ?></td>
                    <td>
                        <?php
                        if ($da['status_anggota'] == 1) {
                            echo"Mahasiswa";
                        } else if ($da['status_anggota'] == 2) {
                            echo"Dosen";
                        } else if ($da['status_anggota'] == 3) {
                            echo"Lain-Lain";
                        }
                        ?>
                    </td>
                    <td style="text-align: center">
                        <form method="post">
                            <input type="hidden" name="id_anggota_penyewaan" value="<?php echo $da['id_registrasi_anggota_penyewaan'] ?>"/>
                            <input type="hidden" name="mode" value="delete-anggota"/>
                            <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                            <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                            <button type="submit" class="btn"><i class="icon-remove"></i></button>
                        </form>
                    </td>
                </tr>
                <?php
                $no++;
            }
            ?>
        </tbody>
    </table>
    <br/>
    <hr/>
    <br/>
    <h2>Biaya Registrasi Pemakaian Fasilitas</h2>
    <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px 10px 10px 10px">
        <fieldset>
            <table id="pasien-penyewaan-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Biaya </th>
                        <th>Bench Fee (Rp)</th>
                        <th>Deposit (Rp)</th>
                        <th>Administrasi (Rp)</th>
                        <th>Jumlah (Rp)</th>
                        <th>Status Biaya</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_penyewaan_biaya as $db) {
                        ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $db['nama_biaya'] ?></td>
                            <td style="text-align: right"><?php echo number_format($db['besar_biaya']) ?> </td>
                            <td style="text-align: right"><?php echo number_format($db['besar_deposit']) ?> </td>
                            <td style="text-align: right"><?php echo number_format($db['besar_biaya_administrasi']) ?> </td>
                            <td style="text-align: right"><?php echo number_format($db['total_biaya']) ?> </td>
                            <td style="text-align: right"><?php echo $db['status_biaya'] == 1 ? "Internal" : "Luar Unair"; ?> </td>
                            <td style="text-align: center">
                                <input type="radio" <?php if ($id_registrasi_penyewaan_biaya == $db['id_registrasi_penyewaan_biaya']) echo "checked='true'"; ?> name="penyewaan_biaya" value="<?php echo $db['id_registrasi_penyewaan_biaya'] ?>"
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                </tbody>
            </table>

            <div class="form-actions">
                <input type="hidden" name="mode" value="penyewaan-biaya"/>
                <input type="hidden" name="id_registrasi" value="<?php echo $id_registrasi ?>"/>
                <input type="hidden" name="no_registrasi" value="<?php echo $no_registrasi ?>"/>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div> <!-- /form-actions -->
        </fieldset>
    </form>
</div>