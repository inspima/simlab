<?php
include 'breadcumbs.php';
//var_dump($pasien_sinkron);

?>
<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Master - Data Pasien Antrian SIMLAB</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Antrian Pasien</h2>
                <form class="form-horizontal form-validation"  method="post" style="width: 90%">
                    <table class="table table-bordered" style="width:35%">
                        <tr>
                            <td>Tanggal Registrasi</td>
                            <td><input type="text" class="span2 datepicker validate[required]" name="awal" value="<?php if($awal == null) {echo date('Y-m-d');} else {echo $awal;}?>"></td>
                            <td><button type="submit" class="btn btn-primary">Submit</button></td>
                        </tr>
                    </table> 
                
                </form>
                <table style="margin :10px 0px" id="pasien-datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Test</th>
                            <th>Tgl Lahir (Umur)</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telephone, HP</th>
                            <th>-</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Test</th>
                            <th>Tgl Lahir (Umur)</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Telephone, HP</th>
                            <th>-</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                     <tbody>
                        <?php
                        foreach ($pasien_sinkron as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['name'] ?></td>
                                <td><?php echo $d['id_number'] ?></td>
                                <td><?php echo $d['test_loop'] ?></td>
                                <td><?php echo date('d-m-Y', strtotime($d['born_date']))." (".$d['age'].")"; ?></td>
                                <td><?php if($d['gender'] == 1){echo "Laki - Laki";}
                                                elseif($d['gender'] == 2) {echo "Perempuan";}
                                                    else {echo "NOT SET";}?></td>
                                <td><?php echo $d['address'] ?></td>
                                <td><?php echo $d['phone'].", ".$d['mobile'] ?></td>
                                <td style="width: 120px;text-align: center">
                                    <div>
                                        <!--<a class="btn" title="View" href="<?php echo Yii::app()->createUrl('master/pegawai/view?id=' . $d['id']); ?>" ><i class="icon-search"></i></a>-->
                                        <a href="#" type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal<?php echo $d['id']; ?>">Edit</a>
                                        
                                        <div class="modal fade" id="myModal<?php echo $d['id']; ?>" role="dialog">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="modal-pasienLabel">Form Edit Pasien</h3>
                                            </div>

                                            <form class="form-horizontal form-validation" method="post" style="">
                                                <?php
                                                $id = $d['id'];
                                                $data = $this->GetData($id);
                                                //echo $d['name'];
                                                    
                                                
                                                ?>
                                                <fieldset>
                                                    <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="nama">Nama</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3 validate[required]" name="nama" value="<?=$data['name']?>">
                                                                
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
                                                        
                                                        <div class="control-group">											
                                                            <label class="control-label" for="nik">NIK</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3 validate[required]" name="nik" value="<?=$data['id_number']?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->
                                                        
                                                        <div class="modal-body">
                                                        <div class="control-group">											
                                                            <label class="control-label" for="nik">Tes Ke</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3 validate[required]" name="teske" value="<?=$data['test_loop']?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->


                                                        <div class="control-group">											
                                                            <label class="control-label">Jenis Kelamin</label>
                                                            <div class="controls">
                                                                <label class="radio inline">
                                                                    <input type="radio" value="1" class="validate[required]"   name="kelamin" <?php if($data['gender'] == 1) {echo " checked ";}?>> Laki-Laki
                                                                </label>

                                                                <label class="radio inline">
                                                                    <input type="radio" value="2" class="validate[required]"  name="kelamin" <?php if($data['gender'] == 2) {echo " checked ";}?>> Perempuan
                                                                </label>
                                                            </div>	<!-- /controls -->			
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="tgl_lahir">Tgl Lahir</label>
                                                            <div class="controls">
                                                                <div id="tanggal_lahir"  class="input-append">
                                                                    <input class="span2 datepicker validate[required]" name="tgl_lahir" id="tgl_lahir" type="text"  value="<?=$data['born_date']?>"  type="text"/>
                                                                   
                                                                </div>
                                                            </div>
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="umur">Umur</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3"  id="umur" name="umur" value="<?=$data['age']?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="telepon">Telepon</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3" name="telepon" value="<?=$data['phone']?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        <div class="control-group">											
                                                            <label class="control-label" for="hp">HP</label>
                                                            <div class="controls">
                                                                <input type="text" class="span3" name="hp" value="<?=$data['mobile']?>">
                                                            </div> <!-- /controls -->				
                                                        </div> <!-- /control-group -->

                                                        

                                                        <div class="control-group">											
                                                            <label class="control-label" for="alamat">Alamat</label>
                                                            <div class="controls">
                                                                <textarea name="alamat"  style="resize: none;height:80px" class="span3"><?=$data['address']?></textarea>
                                                            </div> <!-- /controls -->
                                                        </div> <!-- /control-group -->
                                                    </div>
                                                    <div class="modal-footer">

                                                        <input type="hidden" name="mode" value="pasien"/>
                                                        <input type="hidden" name="id" value="<?=$id?>"/>
                                                        <input type="hidden" name="awal" value="<?=$awal?>"/>
                                                        <button type="submit" class="btn btn-primary">Submit</button> 
                                                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    </div>


                                                    <br/>


                                                </fieldset>
                                            </form>

                                        </div>
                                        
                                    </div>
                                    <p>
                                        <?php if($this->cekData($d['id']) >= 1) {echo '<div class="btn btn-success" ><b>Registered</b></div>';} ?>
                                    </p>
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <button type="submit" class="btn btn-primary">Sinkron</button>
                                        <input type="hidden" name="mode" value="sinkron"/>
                                        <input type="hidden" name="id" value="<?=$id?>"/>
                                        <input type="hidden" name="awal" value="<?=$awal?>"/>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div> <!-- /widget-content -->
        </div> <!-- /widget -->	
    </div> <!-- /spa12 -->
</div> <!-- /row -->
<?php
include 'plugins.php';
?>
<script>
    $(document).ready(function() {
        $('#pasien-datatable').dataTable({
            "lengthChange": true,
        });
        
    });
</script>