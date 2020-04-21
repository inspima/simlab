<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Login - <?php echo CHtml::encode(Yii::app()->name); ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 

        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet"/>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/pages/signin.css" rel="stylesheet" type="text/css">

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
                            <li class="">						
                                <a href="<?php echo Yii::app()->homeUrl; ?>" class="">
                                    <i class="icon-home"></i>
                                    Homepage
                                </a>
                            </li>
                        </ul>
                    </div><!--/.nav-collapse -->	
                </div> <!-- /container -->
            </div> <!-- /navbar-inner -->
        </div> <!-- /navbar -->
        <div class="account-container">
            <div class="content clearfix">
                <form action="<?php echo Yii::app()->request->url ?>" method="post">
                    <div style="text-align:center">
                    <h1>User Login</h1>		
                    <img style="width:100px;height:auto" src="<?php echo Yii::app()->baseUrl; ?>/img/user_lock.png" />
                    <p>Isi form login dibawah ini</p>
                    </div>
                    <div class="login-fields">
                        <?php if (Yii::app()->user->hasFlash('error')): ?>
                            <div class="alert alert-error">
                                <?php echo Yii::app()->user->getFlash('error'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="field">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username"  value="<?php echo Yii::app()->request->getPost('username'); ?>" placeholder="Username" class="login username-field" />
                        </div> <!-- /field -->

                        <div class="field">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" value="" placeholder="Password" class="login password-field"/>
                        </div> <!-- /password -->

                    </div> <!-- /login-fields -->

                    <div class="login-actions">
                        <!--
                            <span class="login-checkbox">
                                <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                                <label class="choice" for="Field">Keep me signed in</label>
                            </span>
                        -->                    
                        <button class="button btn btn-success btn-large">Sign In</button>

                    </div> <!-- .actions -->
                </form>
            </div> <!-- /content -->
        </div> <!-- /account-container -->
        <div class="login-extra">
            <!--<a href="#">Reset Password</a>-->
        </div> <!-- /login-extra -->
        
    </body>
</html>
