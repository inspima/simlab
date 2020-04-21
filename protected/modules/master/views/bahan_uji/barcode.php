<?php 

echo CHtml::image(Yii::app()->request->baseUrl.'/barcode/'.$id.'.jpg','',array());
include 'plugins.php';


?>

<SCRIPT LANGUAGE="JavaScript"> 
    window.print();
</script>
