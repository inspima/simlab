
                <table rules="all" border="1" width="100%">
                    <thead>
                        <tr>
                            <th>Bahan /  Sample</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($sample as $d):
                            ?>
                            <tr>
                                <td><?php echo $d['nama_sample'] ?></td>
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
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control:  must-revalidate, post-check=0, pre-check=0");
header("Content-disposition: attachment; filename=MS_SAMPLE_".date('m-Y').".xls"); 
?>