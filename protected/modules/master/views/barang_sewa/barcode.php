<?php 

echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$id.'.jpg','',array())."<br />";


?>
<table style="margin :10px 0px" border="1" rules="all" id="dokter-datatable" class="table table-bordered" cellspacing="0">
    <?php for($i=0; $i<5; $i++) {?>
    <tr>
        <td>
            <?php
            $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
               'data' => 'qrcode'.$id,
               'subfolderVar' => true,
               'matrixPointSize' => 3,
           )) 

           ?>
        </td>
        <td>
            <address style="margin: 2px 0px; font-size: 12px" class="align-left">
          NoReg  : 0000-201607-0000000047
        <br>Tgl  : 1 Sep 2016</br>
            Nama : Anton Soethipto
        <br>Umur : 31 th</br>
            </address>
        </td>
    </tr>
    <?php } ?>
</table>


<SCRIPT LANGUAGE="JavaScript"> 
    window.print();
</script>
<?php 
include 'plugins.php';
?>
