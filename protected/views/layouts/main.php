<?php
    // AMBIL TEMPLATE USER
    $model_user = User::model()->find()->findByAttributes(array('id_user' => Yii::app()->user->id));
    $model_template_user = TemplateUser::model()->findByAttributes(array('id_user' => Yii::app()->user->id, 'status_aktif' => '1'));
    $model_template = Template::model()->findByAttributes(array('id_template' => $model_template_user->id_template));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.datatables.min.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.datatables.min.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/chosen.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/datepicker.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.datetimepicker.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/validationEngine.jquery.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet"/>


    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <style>
        .notifikasi-ada {
            padding: 0px 4px;
            width: 20px;
            height: 20px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            color: #FFF;
            background: #F62A2A;
            margin: 0px 2px;
            border: 3px solid #F62A2A;
            border-radius: 10px;

        }

        .notifikasi-kosong {
            padding: 0px 4px;
            width: 20px;
            height: 20px;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            color: black;
            background: white;
            margin: 0px 2px;
            border: 3px solid #FFF;
            border-radius: 10px;
        }
    </style>
</head>

<body>
<!--JIKA TEMPLATE PIMPINAN,REGISTRASI DAN SUPERADMIN-->
<?php
    if (in_array($model_template_user->id_template, array(1, 2, 3))) {
        ?>
        <div id="warning-alert" style="display: none;width: 100%;position: fixed;top: 0;z-index: 99">
            <div style="width: 45%;margin: 0px auto;" class="alert alert-warning">
                Perhatian terdapat <span id="warning-penyewaan-jumlah">0</span> order Pemakaian Fasilitas melebihi batas order warning
                <a style="font-size: 0.9em;text-decoration: underline" href="<?php echo Yii::app()->createUrl('registrasi/pemakaian_lab_warning/read') ?>"> Lihat Disini </a>
                <span style="margin: 5px" onclick="$('#warning-alert').fadeOut()" class="pull-right">
                        <i style="cursor: pointer" class="icon icon-remove-sign"></i>
                    </span>
            </div>
        </div>
        <?php
    }
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container" style="width: 95%">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="<?php echo Yii::app()->baseUrl; ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
            <div class="nav-collapse">
                <?php
                    // SUBMENU NOTIFIKASI
                    // UNTUK BAGIAN REGISTRASI DAN PIMPINAN
                    if (in_array($model_template_user->id_template, array(2, 3, 6, 8))) {
                        $array_submenu_notifikasi = array(/*array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-warning">0</span> Pemakaian Warning',
                                    'url' => Yii::app()->createUrl('registrasi/pemakaian_lab_warning/read'),
                                ),
                                 array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-sudah">0</span> Sudah Validasi',
                                    'url' => Yii::app()->createUrl('registrasi/pemeriksaan_validasi/read'),
                                ),*/
                        );
                    } else if (in_array($model_template_user->id_template, array(4))) {
                        $array_submenu_notifikasi = array(/*array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-baru">0</span> Pemeriksaan Baru',
                                    'url' => Yii::app()->createUrl('pemeriksaan/input_hasil/read'),
                                ),
                                array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-proses">0</span> Proses Pengujian',
                                    'url' => Yii::app()->createUrl('pemeriksaan/input_hasil/read'),
                                ),
                                array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-sudah">0</span> Sudah Validasi',
                                    'url' => Yii::app()->createUrl('registrasi/pemeriksaan_validasi/read'),
                                ),*/
                        );
                    } else if (in_array($model_template_user->id_template, array(5))) {
                        $array_submenu_notifikasi = array(/*array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-proses">0</span> Proses Pengujian',
                                    'url' => Yii::app()->createUrl('pemeriksaan/validasi_hasil/read'),
                                ),
                                 array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-sudah">0</span> Sudah Validasi',
                                    'url' => Yii::app()->createUrl('registrasi/pemeriksaan_validasi/read'),
                                ),*/
                        );
                    } else if (in_array($model_template_user->id_template, array(1))) {
                        $array_submenu_notifikasi = array(/*array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-baru">0</span> Pemeriksaan Baru',
                                    'url' => Yii::app()->createUrl('pemeriksaan/input_hasil/read'),
                                ),
                                array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-proses">0</span> Proses Pengujian',
                                    'url' => Yii::app()->createUrl('pemeriksaan/input_hasil/read'),
                                ),
                                array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-warning">0</span> Pemakaian Warning',
                                    'url' => Yii::app()->createUrl('registrasi/pemakaian_lab_warning/read'),
                                ),
                                array(
                                    'label' => '<i class="icon-caret-right"></i> <span id="jumlah-notifikasi-sudah">0</span> Sudah Validasi',
                                    'url' => Yii::app()->createUrl('registrasi/pemeriksaan_validasi/read'),
                                ),*/
                        );
                    }
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array(
                                'label' => '<span id="jumlah-notifikasi" class=""></span></i> Notifikasi Sistem</b>',
                                'url' => Yii::app()->createUrl('setting/notifikasi/unread'),
                                'items' => $array_submenu_notifikasi,
                            ),
                            array(
                                'label' => '<i class="icon-user"></i> Akun <b class="caret"></b>',
                                'url' => '#',
                                'linkOptions' => array(
                                    'class' => 'dropdown-toggle',
                                    'data-toggle' => 'dropdown',
                                ),
                                'itemOptions' => array('class' => 'dropdown'),
                                'items' => array(
                                    array(
                                        'label' => '<i class="icon-key"></i> Log Out',
                                        'url' => Yii::app()->createUrl('site/logout'),
                                    ),
                                )
                            ),
                        ),
                        'encodeLabel' => false,
                        'htmlOptions' => array(
                            'class' => 'nav pull-right',
                        ),
                        'submenuHtmlOptions' => array(
                            'class' => 'dropdown-menu',
                        )
                    ));
                ?>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!-- /container -->
    </div>
    <!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container" style="width: 95%">
            <?php
                // MENU USER
                $array_menu_user = array();
                $query_menu = "
                        select m.*
                        from template_menu tm
                        join menu m on tm.id_menu=m.id_menu
                        where tm.id_template='" . $model_template_user->id_template . "'
                        and m.id_parent_menu is null
                        order by m.order
                        ";
                $menu = Yii::app()->db->createCommand($query_menu)->queryAll();

                // BUAT TAMPILAN MENU UNTUK USER
                foreach ($menu as $mu) {

                    // CEK SUBMENU
                    $query_submenu = "select * from menu where id_parent_menu='{$mu['id_menu']}' and id_menu in (select id_menu from template_menu where id_template='" . $model_template_user->id_template . "') and is_active=1";
                    $submenu = Yii::app()->db->createCommand($query_submenu)->queryAll();
                    if (count($submenu) > 0) {
                        $array_submenu = array();
                        foreach ($submenu as $sm) {
                            array_push($array_submenu, array(
                                'label' => $sm['label'],
                                'url' => Yii::app()->createUrl($sm['url'])
                            ));
                        }
                        array_push($array_menu_user, array(
                            'label' => "<i class='{$mu['icon']}'></i><span>{$mu['label']}</span> <b class='caret'></b>",
                            'url' => '#',
                            'linkOptions' => array(
                                'class' => 'dropdown-toggle',
                                'data-toggle' => 'dropdown',
                            ),
                            'itemOptions' => array('class' => 'dropdown'),
                            'items' => $array_submenu
                        ));
                    } else {
                        array_push($array_menu_user, array(
                            'label' => "<i class='{$mu['icon']}'></i><span>{$mu['label']}</span>",
                            'url' => Yii::app()->createUrl($mu['url'])
                        ));
                    }
                }
                // SELESAI BUAT MENU

                $this->widget('zii.widgets.CMenu', array(
                    'items' => $array_menu_user,
                    'encodeLabel' => false,
                    'htmlOptions' => array(
                        'class' => 'main-nav',
                    ),
                    'submenuHtmlOptions' => array(
                        'class' => 'dropdown-menu',
                    )
                ));
            ?>
            <div class="pull-right" style="margin: 12px 0px;;height: auto;width: auto">
                <p class="navbar pull-right" style="color: grey;text-align: left;" href="">
                    <span style="margin: 0px 8px"><b>User Login : </b><?php echo $model_user['nama_user']; ?></span>
                    <span style="margin: 0px 8px"> <b>Akses : </b><?php echo $model_template['nama_template']; ?></span>
                </p>
            </div>
        </div>
        <!-- /container -->
    </div>
    <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->
<div class="main">
    <div class="main-inner">
        <div class="container" style="width: 95%">
            <?php echo $content; ?>
            <!-- /row -->

        </div>
        <!-- /container -->
    </div>
    <!-- /main-inner -->
</div>
<!-- /main -->
<!-- /extra -->
<div class="footer">
    <div class="footer-inner">
        <div class="container" style="width: 95%">
            <div class="row">
                <div class="span12"> &copy; 2014 <a href="http://www.facebook.com/nambisembilu">Matooh Team</a>.</div>
                <!-- /span12 -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /footer-inner -->
</div>
<!-- /footer -->
<input type="hidden" id="base_url_app" value="<?php echo Yii::app()->baseUrl; ?>"/>

</body>
</html>