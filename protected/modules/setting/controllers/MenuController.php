<?php

class MenuController extends Controller {

    /**
     * @return array action filters
     */
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
                'actions' => array('read', 'view', 'create', 'update', 'delete'),
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Declares class-based actions.
     */
    public function actionRead() {
        // AUTO INSERT ALL MENU TO SUPER ADMIN
        Yii::app()->db->createCommand("
            insert into template_menu (id_template,id_menu) 
            select 1 id_template,id_menu 
            from menu 
            where id_menu not in (
                select id_menu 
                from template_menu 
                where id_template=1
            )")->query();
        // AUTO DELETE MENU NOT IN TEMPLATE MENU
        $query_view = "
            select m.*,pm.label parent_label from menu m
            left join menu pm on pm.id_menu=m.id_parent_menu
            order by m.url asc
            ";
        Yii::app()->db->createCommand("
            delete from template_menu
            where id_menu not in (
                select id_menu from menu
            )")->query();
        $data = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_menu' => $data
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $menu = Menu::model()->findByPk($id);

        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('view', array(
            'siswa' => $menu,
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama
        ));
    }

    public function actionCreate() {
        if(!empty($_POST)) {
            $menu = new Menu;
            $menu->id_parent_menu = Yii::app()->request->getPost('parent');
            $menu->label = Yii::app()->request->getPost('label');
            $menu->url = Yii::app()->request->getPost('url');
            $menu->order = Yii::app()->request->getPost('order');
            $menu->icon = Yii::app()->request->getPost('icon');
            if ($menu->save()) {
                Yii::app()->user->setFlash('success', 'Data Menu berhasil dimasukkan');
            } else {
                print_r($menu->getErrors());
            }
        }
        $query_parent_menu = "
            select * from menu where id_parent_menu is null
            ";
        $data_parent_menu = Yii::app()->db->createCommand($query_parent_menu)->queryAll();
        $this->render('create', array(
            'data_parent_menu' => $data_parent_menu
        ));
    }

    public function actionUpdate() {
        $id = Yii::app()->request->getQuery('id');
        $menu = Menu::model()->findByPk($id);
        if (!empty($_POST)) {
            $menu->id_parent_menu = Yii::app()->request->getPost('parent');
            $menu->label = Yii::app()->request->getPost('label');
            $menu->url = Yii::app()->request->getPost('url');
            $menu->order = Yii::app()->request->getPost('order');
            $menu->icon = Yii::app()->request->getPost('icon');
            $menu->is_active = Yii::app()->request->getPost('is_active');
            if ($menu->save()) {
                Yii::app()->user->setFlash('success', 'Data Menu berhasil dirubah');
            } else {
                print_r($menu->getErrors());
            }
        }
        $query_parent_menu = "
            select * from menu where id_parent_menu is null
            ";
        $data_parent_menu = Yii::app()->db->createCommand($query_parent_menu)->queryAll();
        $this->render('update', array(
            'menu' => $menu,
            'data_parent_menu' => $data_parent_menu
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Menu::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
