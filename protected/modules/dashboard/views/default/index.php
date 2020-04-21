<?php
include 'breadcumbs.php';
?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    var json = <?php echo $json_siswa; ?>;
    var iconHome = '<?php echo Yii::app()->createUrl('img/home-icon.png'); ?>';
    var infoWindow = new google.maps.InfoWindow();
    var latLng = new google.maps.LatLng(-7.265075458328397, 112.74169921946134);
    var zoom = 12;


    function InitGmaps() {
        var map = new google.maps.Map(document.getElementById('mapCanvas'), {
            zoom: zoom,
            center: latLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        GetJsonMaps(map);

    }

    function GetJsonMaps(map) {
        for (var i = 0, length = json.length; i < length; i++) {
            var data = json[i];
            latLng_json = new google.maps.LatLng(data.alamat_latitude, data.alamat_longitude);
            // Creating a marker and putting it on the map
            var marker_json = new google.maps.Marker({
                position: latLng_json,
                title: data.nama_siswa,
                map: map,
                icon: iconHome
            });

            (function(marker_json, data) {
                // Attaching a click event to the current marker
                google.maps.event.addListener(marker_json, "click", function(e) {
                    infoWindow.setContent('Nama :' + data.nama_siswa + '<br/>' + 'Alamat : ' + data.alamat + '<br/>' + 'Kekhususan : ' + data.kekhususan);
                    infoWindow.open(map, marker_json);
                });

            })(marker_json, data);
        }
    }

</script>
</head>

<style>
    #mapCanvas {
        width: 100%;
        height: 450px;
    }

</style>
<div class="row">
    <div class="span12">
        <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
                <h3> Dashboard </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="widget big-stats-container">
                    <div class="widget-content" style="padding: 20px">
                        <h3 class="bigstats">Peta Persebaran Siswa</h3>
                        <form class="form-horizontal form-validation" method="post" style="width: 98%;margin: 20px 0px;">
                            <fieldset>
                                <div class="control-group">											
                                    <label class="control-label" for="siswa">Pencarian</label>
                                    <div class="controls">
                                        <select name="siswa" id="siswa_cari" class="chosen span5" tabindex="2">
                                            <option>Pilih Siswa</option>
                                            <?php
                                            foreach ($data_siswa as $d):
                                                ?>
                                                <option value="<?php echo $d['id_siswa'] ?>"><?php echo $d['nama_siswa'] ?></option>
                                                <?php
                                            endforeach;
                                            ?>
                                        </select>
                                    </div> <!-- /controls -->				
                                </div> <!-- /control-group -->
                            </fieldset>
                        </form>
                        <script>
                            window.onload = function() {
                                InitGmaps();
                            };

                        </script>
                        <div id="mapCanvas"></div>
                    </div>
                    <!-- /widget-content --> 

                </div>
            </div>
        </div>

        <!-- /widget --> 
    </div>
    <!-- /span12 -->

</div>

<?php
include 'plugins.php';
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#siswa_cari').chosen().change(function() {
            $.getJSON("<?php echo Yii::app()->createUrl('dashboard/default/getJsonSiswa?'); ?>" + 's=' + $(this).val(), function(data) {
                latLngSiswa = new google.maps.LatLng(data.alamat_latitude, data.alamat_longitude);
                var map = new google.maps.Map(document.getElementById('mapCanvas'), {
                    zoom: zoom,
                    center: latLngSiswa,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // Creating a marker and putting it on the map
                var marker_json = new google.maps.Marker({
                    position: latLngSiswa,
                    title: data.nama_siswa,
                    map: map,
                    icon: iconHome
                });

                (function(marker_json, data) {
                    // Attaching a click event to the current marker
                    google.maps.event.addListener(marker_json, "click", function(e) {
                        infoWindow.setContent('Nama :' + data.nama_siswa + '<br/>' + 'Alamat : ' + data.alamat + '<br/>' + 'Kekhususan : ' + data.kekhususan);
                        infoWindow.open(map, marker_json);
                    });

                })(marker_json, data);
            });
        });
    });
</script>
