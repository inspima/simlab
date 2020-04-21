<?php

class BarcodeController extends Controller {
    
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('Create'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }
    
    
    public function actionCreate($id, $jenis) {
        $this->layout = false;
        $id = Yii::app()->request->getQuery('id');
        $jenis = Yii::app()->request->getQuery('jenis');
        $width  = 180;  
        //Height of the barcode image.
        $height = 84;
        //Quality of the barcode image. Only for JPEG.
        $quality = 100;
        //1 if text should appear below the barcode. Otherwise 0.
        $text =1;
        
        $tempat = Yii::getPathOfAlias("webroot").'/barcode/'.$jenis.'/';
        if(!file_exists($tempat)) {
            mkdir(Yii::getPathOfAlias("webroot").'/barcode/'.$jenis);
            } 
        
        // Location of barcode image storage.
        $location = Yii::getPathOfAlias("webroot").'/barcode/'.$jenis.'/'.$id.'.jpg';
        Yii::import("application.extensions.barcode.*");                      
        barcode::Barcode39($id, $width , $height , $quality, $text, $location);
        //$this->redirect('view?id='.$id);
        $this->render('create', array(
         
            'id' => $id,
            'jenis' => $jenis
            
            
        ));
    }
    
}

