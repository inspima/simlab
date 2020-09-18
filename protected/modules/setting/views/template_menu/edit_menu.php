<?php
include 'breadcumbs.php';
?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget">
            <div class="widget-header">
                <i class=" icon-tasks"></i>
                <h3>Edit Data Template Menu</h3>
            </div> <!-- /widget-header -->
            <div class="widget-content">    
                <h2>Data Menu</h2>
                <p style="margin: 20px 0px"><a class="btn btn" href="<?php echo Yii::app()->createUrl('setting/template_menu/read'); ?>"><i class="icon-chevron-left"></i>&nbsp;&nbsp;Back</a></p>
                <?php if (Yii::app()->user->hasFlash('success')): ?>
                    <div class="alert alert-success">
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                <?php endif; ?>
                <form class="form-horizontal form-validation" method="post" style="width: 90%">
                    <fieldset>

                        <div class="control-group">											
                            <label class="control-label" for="nama">Nama Template</label>
                            <div class="controls">
                                <h3><?php echo $template['nama_template'] ?></h3>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <div class="control-group">											
                            <label class="control-label" for="nama">Data Template Menu</label>
                            <div class="controls">
                                <ul>
                                    <?php
                                    $no_menu=1;
                                    foreach ($template_menu as $tm) {
                                        if (count($tm['CHILD_MENU']) > 0) {
                                            ?>
                                            <li> 
                                                <input type="checkbox" class="parent" id="<?php echo $tm['id_menu'] ?>" name="menu<?php echo $no_menu ?>" value="1" <?php if($tm['id_template']!=''){echo 'checked="true"';}?>/>
                                                <input type="hidden" name="id_menu<?php echo $no_menu ?>" value="<?php echo $tm['id_menu'] ?>" />
                                                <?php echo $tm['label'] ?> 
                                                <ul>
                                                    <?php
                                                    foreach ($tm['CHILD_MENU'] as $cm) {
                                                        $no_menu++;
                                                        ?>
                                                        <li>
                                                            <input class="child parent<?php echo $tm['id_menu'] ?>" parent-id="<?php echo $tm['id_menu'] ?>" name="menu<?php echo $no_menu ?>" type="checkbox" value="1" <?php if($cm['id_template']!=''){echo 'checked="true"';}?>/>
                                                            <input type="hidden" name="id_menu<?php echo $no_menu ?>" value="<?php echo $cm['id_menu'] ?>" />
                                                            <?php echo $cm['label'] ?> 
                                                            
                                                        </li> 
                                                        <?php                                                        
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                        } else {
                                            ?>
                                            <li> 
                                                <input name="menu<?php echo $no_menu ?>" type="checkbox" value="1" <?php if($tm['id_template']!=''){echo 'checked="true"';}?> />
                                                <input type="hidden" name="id_menu<?php echo $no_menu ?>" value="<?php echo $tm['id_menu'] ?>" />
                                                <?php echo $tm['label'] ?>
                                                
                                            </li>
                                                <?php
                                            }
                                            $no_menu++;
                                        }
                                        ?>
                                </ul>
                            </div> <!-- /controls -->				
                        </div> <!-- /control-group -->
                        <br />

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">Save</button> 
                            <input type="hidden" name="jumlah_menu" value="<?php echo $no_menu ?>"/>
                            <input type="hidden" name="id_template" value="<?php echo $template['id_template'] ?>"/>
                            <a class="btn"  href="<?php echo Yii::app()->createUrl('setting/template_menu/read'); ?>">Cancel</a>
                        </div> <!-- /form-actions -->
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
            "lengthChange": true,
        });
        $('.parent').click(function(){
            id_parent = $(this).attr('id');
            if ($(this).is(':checked')) {
                $('.parent' + id_parent).attr('checked', true);
            } else {
                $('.parent' + id_parent).attr('checked', false);
            }
        });
        $('.child').click(function(){
            id_parent = $(this).attr('parent-id');
            if ($(this).is(':checked')) {
                $('#' + id_parent).attr('checked', true);
            } else {
                $('#' + id_parent).attr('checked', true);
            }
        });
    });
</script>