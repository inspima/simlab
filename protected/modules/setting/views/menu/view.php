<?php
include 'breadcumbs.php';
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var markerIconAdd = '<?php echo Yii::app()->createUrl('img/marker.png'); ?>';
    var infoWindow = new google.maps.InfoWindow();
    var latLng = new google.maps.LatLng(<?php echo ($siswa['alamat_latitude'] == '' ? -7.27546261524964 : $siswa['alamat_latitude']) ?>, <?php echo ($siswa['alamat_longitude'] == '' ? 112.74290084910149 : $siswa['alamat_longitude']) ?>);
    var zoom = 13;


    function InitGmaps() {
        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: zoom,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marker = new google.maps.Marker({
            position: latLng,
            title: 'Interesting Point',
            map: map,
            icon: markerIconAdd,
            draggable: true
        });
        
        infoWindow.setContent("<?php echo ($siswa['alamat_latitude'] != '' && $siswa['alamat_longitude'] != '') ? $siswa['alamat'] : ''; ?>");
        infoWindow.open(map, marker);

    }



</script>

<style>
    #mapCanvas {
        width: 700px;
        height: 300px;
    }

</style>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Ubah Data Siswa</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Siswa</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('master/siswa/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                                <input type="text"  readonly="true" class="span8 validate[required]" name="nama" value="<?php echo $siswa['nama_siswa'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label">Jenis Kelamin</label>
                            <div class="controls">
                                <label class="radio inline">
                                    <input type="radio" readonly="true"  value="1" class="validate[required]" <?php
                                    if ($siswa['jenis_kelamin'] == 1) {
                                        echo "checked='true'";
                                    }
                                    ?> name="jenis_kelamin"> Laki-Laki
                                </label>

                                <label class="radio inline">
                                    <input type="radio" readonly="true"  value="2" class="validate[required]" <?php
                                    if ($siswa['jenis_kelamin'] == 2) {
                                        echo "checked='true'";
                                    }
                                    ?> name="jenis_kelamin"> Perempuan
                                </label>
                            </div>	<!-- /controls -->			
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="tgl_lahir">Tanggal Lahir</label>
                            <div class="controls">
                                <input type="text" readonly="true"  class="span2 datepicker validate[required]" name="tgl_lahir" value="<?php echo $siswa['tgl_lahir'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="agama">Agama</label>
                            <div class="controls">
                                <select name="agama" readonly="true"  class="chosen span5" id="agama" data-placeholder="Pilih Agama..." tabindex="2">
                                    <?php
                                    foreach ($data_agama as $d):
                                        ?>
                                        <option value="<?php echo $d['id_agama'] ?>" <?php
                                        if ($siswa['id_agama'] == $d['id_agama']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $d['nama_agama'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="propinsi">Propinsi</label>
                            <div class="controls">
                                <select name="propinsi" class="chosen span5" id="propinsi" data-placeholder="Pilih Propinsi..." tabindex="2">
                                    <?php
                                    foreach ($data_propinsi as $d):
                                        ?>
                                        <option  readonly="true" value="<?php echo $d['id_propinsi'] ?>"><?php echo $d['nama_propinsi'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <div id="kota_loading"></div>
                        <div class="control-group">											
                            <label class="control-label" for="kota">Kota Lahir</label>
                            <div class="controls">
                                <select name="kota" readonly="true"  class="chosen span5 validate[required]" id="kota" data-placeholder="Pilih Kota..." tabindex="2"></select>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="nama_ortu">Nama Ortu</label>
                            <div class="controls">
                                <input type="text" readonly="true"  class="span8" name="nama_ortu" value="<?php echo $siswa['nama_ortu'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="pekerjaan_ortu">Pekerjaan Ortu</label>
                            <div class="controls">
                                <input type="text" readonly="true"  class="span8" name="pekerjaan_ortu" value="<?php echo $siswa['pekerjaan_ortu'] ?>">
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="kekhususan">Kekhususan</label>
                            <div class="controls">
                                <textarea name="kekhususan"  readonly="true" style="resize: none;height:80px" class="validate[required] span6"><?php echo $siswa['kekhususan'] ?></textarea>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                                <textarea name="alamat"  readonly="true"  style="resize: none;height:80px" class="span6"><?php echo $siswa['alamat'] ?></textarea>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->

                        <div class="control-group">											
                            <label class="control-label" for="alamat">Alamat Map</label>
                            <div class="controls">
                                <script>
                                    window.onload = function() {
                                        InitGmaps();
                                    };
                                </script>
                                <div id="mapCanvas" style="margin: 20px"></div>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                    </fieldset>
                </form>
            </div>

        </div> <!-- /widget-content -->
    </div> <!-- /widget -->	
</div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('table.datatable').dataTable({
            "lengthChange": true
        });
    });
</script>