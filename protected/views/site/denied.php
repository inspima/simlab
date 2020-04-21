<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>404 - <?php echo CHtml::encode(Yii::app()->name); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 

        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome.css" rel="stylesheet">
        
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/font/font-open-sans.css" rel="stylesheet"/>

    </head>

    <body>

        <div class="navbar navbar-fixed-top">

            <div class="navbar-inner">

                <div class="container">

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="<?php echo Yii::app()->homeUrl; ?>">
                        <?php echo CHtml::encode(Yii::app()->name); ?>			
                    </a>		

                    <div class="nav-collapse">
                        <ul class="nav pull-right">

                            
                        </ul>

                    </div><!--/.nav-collapse -->	

                </div> <!-- /container -->

            </div> <!-- /navbar-inner -->

        </div> <!-- /navbar -->



        <div class="container">

            <div class="row">

                <div class="span12">

                    <div class="error-container">
                        <h1></h1>

                        <h2>Error : Access Denied</h2>

                        

                        

                    </div> <!-- /error-container -->			

                </div> <!-- /span12 -->

            </div> <!-- /row -->

        </div> <!-- /container -->


        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.js"></script>

    </body>

</html>
