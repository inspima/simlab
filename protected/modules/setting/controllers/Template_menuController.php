<?php

class Template_menuController extends Controller {

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
                'actions' => array('read', 'create', 'update', 'delete', 'edit_menu'),
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
        $query_view = "
            select * from template
            ";
        $data = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_template' => $data
        ));
    }

    public function actionView($id) {
        $id = Yii::app()->request->getQuery('id');
        $template = Template::model()->findByPk($id);

        $data_propinsi = Propinsi::model()->findAll();
        $data_agama = Agama::model()->findAll();
        $this->render('view', array(
            'siswa' => $template,
            'data_propinsi' => $data_propinsi,
            'data_agama' => $data_agama
        ));
    }

    public function actionCreate() {
        if (!empty($_POST)) {
            $template = new Template;
            $template->nama_template = Yii::app()->request->getPost('nama');
            if ($template->save()) {
                Yii::app()->user->setFlash('success', 'Data Template berhasil dimasukkan');
            } else {
                print_r($template->getErrors());
            }
        }
        $this->render('create');
    }

    public function actionEdit_menu($id) {
        $id = Yii::app()->request->getQuery('id');
        if (!empty($_POST)) {
            $id_template = Yii::app()->request->getPost('id_template');
            $jumlah_menu = Yii::app()->request->getPost('jumlah_menu');
            $total_berhasil = 0;
            Yii::app()->db->createCommand("delete from template_menu where id_template='{$id_template}'")->query();
            for ($i = 0; $i < $jumlah_menu; $i++) {
                $menu_check = Yii::app()->request->getPost('menu' . $i);
                $id_menu = Yii::app()->request->getPost('id_menu' . $i);
                if ($menu_check == '1') {
                    $template_menu = new TemplateMenu;
                    $template_menu->id_template = $id;
                    $template_menu->id_menu = $id_menu;
                    $template_menu->save();
                    $total_berhasil++;
                }
            }
            if ($total_berhasil > 0) {
                Yii::app()->user->setFlash('success', 'Data Template berhasil diupdate');
            }
        }
        $template = Template::model()->findByPk($id);
        $arr_template_menu = array();
        $query_parent_menu = "
            select m.*,tm.id_template
            from menu m
            left join template_menu tm on tm.id_menu=m.id_menu and tm.id_template='{$id}'
            where m.id_parent_menu is null
            order by m.order
            ";
        $parent_menu = Yii::app()->db->createCommand($query_parent_menu)->queryAll();
        foreach ($parent_menu as $pm) {
            $query_child_menu = "
            select m.*,tm.id_template
            from menu m
            left join template_menu tm on tm.id_menu=m.id_menu and tm.id_template='{$id}'
            where m.id_parent_menu='{$pm['id_menu']}'
            order by m.order
            ";
            $child_menu = Yii::app()->db->createCommand($query_child_menu)->queryAll();
            array_push($arr_template_menu, array_merge($pm, array('CHILD_MENU' => $child_menu)));
        }

        $this->render('edit_menu', array(
            'template' => $template,
            'template_menu' => $arr_template_menu
        ));
    }

    public function actionUpdate($id) {
        $id = Yii::app()->request->getQuery('id');
        $template = Template::model()->findByPk($id);
        if (!empty($_POST)) {
            $template->nama_template = Yii::app()->request->getPost('nama');
            if ($template->save()) {
                Yii::app()->user->setFlash('success', 'Data Template berhasil dirubah');
            } else {
                print_r($template->getErrors());
            }
        }
        $this->render('update', array(
            'template' => $template
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Template::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
