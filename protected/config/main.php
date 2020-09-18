<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'SIM LABORATORIUM',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'itdunairgii',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1', '210.57.211.72', '114.*.*.*', '36.*.*.*', '180.*.*.*', '210.57.215.114'),
            'generatorPaths' => array('ext.giiheart'),
        ),
        'dashboard',
        'master',
        'pemeriksaan',
        'registrasi',
        'setting',
        'laporan'
    ),
    'defaultController' => 'site',
    // application components
    'components' => array(
        'user' => array(
            # login form path
            'loginUrl' => array('/site/login'),
            # page after login
            'returnUrl' => array('/site/index'),
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        'cache'=> [
            'class'=>'CDummyCache',
        ],
        /*
          'db' => array(
          'connectionString' => 'sqlite:protected/data/blog.db',
          'tablePrefix' => 'tbl_',
          ),
         */
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=simlab',
            'emulatePrepare' => true,
            'username' => 'proyek',
            'password' => 'Pr0y3k-dev',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => '/site/error',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
        'ePdf' => array(
            'class' => 'ext.yii-pdf.EYiiPdf',
            'params' => array(
                'mpdf' => array(
                    'librarySourcePath' => 'application.vendors.mpdf.*',
                    'constants' => array(
                        '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                    ),
                    'class' => 'mpdf', // the literal class filename to be loaded from the vendors folder
                    'defaultParams' => array(// More info: http://mpdf1.com/manual/index.php?tid=184
                        'mode' => '', //  This parameter specifies the mode of the new document.
                        'format' => 'A4', // format A4, A5, ...
                        'default_font_size' => 0, // Sets the default document font size in points (pt)
                        'default_font' => '', // Sets the default font-family for the new document.
                        'mgl' => 10, // margin_left. Sets the page margins for the new document.
                        'mgr' => 10, // margin_right
                        'mgt' => 10, // margin_top
                        'mgb' => 10, // margin_bottom
                        'mgh' => 9, // margin_header
                        'mgf' => 9, // margin_footer
                        'orientation' => 'P', // landscape or portrait orientation
                    )
                ),
                'HTML2PDF' => array(
                    'librarySourcePath' => 'application.vendors.html2pdf.*',
                    'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
                    'defaultParams' => array(// More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
                        'orientation' => 'P', // landscape or portrait orientation
                        'format' => 'A4', // format A4, A5, ...
                        'language' => 'en', // language: fr, en, it ...
                        'unicode' => true, // TRUE means clustering the input text IS unicode (default = true)
                        'encoding' => 'UTF-8', // charset encoding; Default is UTF-8
                        'marges' => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
                    )
                )
            ),
        ),
    ),
    // date format
    'timeZone' => 'Asia/Jakarta',
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => require(dirname(__FILE__) . '/params.php'),
);
