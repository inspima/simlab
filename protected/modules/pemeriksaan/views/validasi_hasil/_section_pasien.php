<h2>Informasi Pasien</h2>
<hr/>
<form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 10px">
    <fieldset>
        <div class="control-group">
            <label class="control-label" for="pasien">Nama</label>
            <div class="controls">
                <?=$data_pasien['nama']?>
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->
        <div class="control-group">											
            <label class="control-label" for="instansi">Instansi Asal</label>
            <div class="controls">
            <?php
            foreach ($data_instansi as $d):
                if ($data_registrasi['id_instansi'] == $d['id_instansi']) echo $d['nama_instansi'];
            endforeach;
            ?>
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->
        <div class="control-group">											
            <label class="control-label" for="instansi">Tempat, Tanggal Lahir</label>
            <div class="controls">
            <?php
                if($data_pasien['nama_kota']!=''){
                    echo $data_pasien['nama_kota'].', '.date('d/m/Y',strtotime($data_pasien['tgl_lahir']));
                }else{
                    echo '<i style="color:orange">Kota lahir kosong</i>'.', '.date('d/m/Y',strtotime($data_pasien['tgl_lahir']));
                }
            ?>
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->        
        <div class="control-group">
            <label class="control-label" for="pasien">Umur</label>
            <div class="controls">
                <?=$umur_pasien?>
            </div> <!-- /controls -->
        </div> <!-- /control-group -->
        <div class="control-group">											
            <label class="control-label" for="no_registrasi">No.Registrasi</label>
            <div class="controls">
            <?= $data_registrasi['no_registrasi'] ?>
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->
        <div class="control-group">											
            <label class="control-label" for="waktu_registrasi">Waktu Registrasi</label>
            <div class="controls">
                <?php echo $data_registrasi['waktu_registrasi'] ?>
            </div>
        </div> <!-- /control-group -->
        <div class="control-group">											
            <label class="control-label" for="pasien_tipe">Tipe Pasien</label>
            <div class="controls">
                    <?php
                    foreach ($data_pasien_tipe as $d):
                        if ($d['jenis_pasien_tipe'] == 2) {
                            if ($data_registrasi['id_pasien_tipe'] == $d['id_pasien_tipe'])
                            echo $d['nama_pasien_tipe'];                                     
                        }
                    endforeach;
                    ?>
            </div> <!-- /controls -->				
        </div> <!-- /control-group -->
        <div class="control-group">											
            <label class="control-label" for="dokter_pengirim">Dokter Pengirim</label>
            <div class="controls">
                <div style="width: 60%">
                    <?php
                        foreach ($data_dokter as $d):
                            if ($data_registrasi['id_dokter_pengirim'] == $d['id_dokter']) echo $d['gelar_depan'] . ' ' . $d['nama_dokter'] . ' ' . $d['gelar_belakang'];
                        endforeach;
                    ?>
                </div>
            </div> <!-- /controls -->
        </div> <!-- /control-group -->
    </fieldset>
</form>