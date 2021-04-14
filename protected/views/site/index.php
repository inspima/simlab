<?php
    // AMBIL TEMPLATE USER
    $model_user = User::model()->find()->findByAttributes(array('id_user' => Yii::app()->user->id));
?>
    <div class="row-fluid">

        <div class="span12">
            <div class="widget"> <!-- /widget-header -->
                <div class="widget-header" style="background: #e7e7e7 !important">
                    <h3></h3>
                </div>
                <div class="widget-content" style="text-align: center">
                    <h2 style="margin-top: 30px;color: #0f79ad">Hi, <?php echo $model_user['nama_user']; ?></h2>
                    <h3 style="">Selamat Datang</h3>
                    <p style="margin: 20px">
                        <img width="30%" src="<?php echo Yii::app()->baseUrl; ?>/img/dashboard.svg">
                    </p>
                </div>

            </div> <!-- /widget-content -->
        </div> <!-- /widget -->

    </div> <!-- /row -->
<?php
    include 'plugins.php';
?>