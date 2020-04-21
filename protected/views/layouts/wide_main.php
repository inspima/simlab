<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-print.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.datatables.min.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/chosen.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/datepicker.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.datetimepicker.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/validationEngine.jquery.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/font/font-open-sans.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet"/>



        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body style="background: none">


        <!-- /subnavbar -->
        <div class="main" style="border: none">
            <?php echo $content; ?>
            <!-- /container --> 
            <!-- /main-inner --> 
        </div>
        <!-- /main -->


    </body>
</html>