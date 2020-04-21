<?php

class User_templateController extends Controller {

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
                'actions' => array('read', 'template'),
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
            select p.*,k.nama_kota,ag.nama_agama,jab.nama_jabatan,u.*,tu.*,tem.nama_template
            from pegawai p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            left join jabatan jab on jab.id_jabatan=p.id_jabatan
            join user u on u.id_user=p.id_user
            left join template_user tu on tu.id_user=u.id_user and tu.status_aktif=1
            left join template tem on tem.id_template=tu.id_template
            order by p.nama_pegawai
            ";
        $data_personil = Yii::app()->db->createCommand($query_view)->queryAll();
        $this->render('read', array(
            'data_personil' => $data_personil
        ));
    }

    public function actionTemplate() {
        $id = Yii::app()->request->getQuery('id');
        $query_personil = "
            select p.*,k.nama_kota,ag.nama_agama,jab.nama_jabatan,u.*
            from pegawai p
            left join kota k on k.id_kota=p.id_kota_lahir
            left join agama ag on ag.id_agama=p.id_agama
            left join jabatan jab on jab.id_jabatan=p.id_jabatan
            join user u on u.id_user=p.id_user
            where p.id_pegawai='{$id}'
            order by p.nama_pegawai
            ";
        $personil = Yii::app()->db->createCommand($query_personil)->queryRow();
        
        if (!empty($_POST)) {
            $mode = Yii::app()->request->getPost('mode');
            if ($mode == 'tambah_template') {
                $template_user = new TemplateUser;
                $template_user->id_template = Yii::app()->request->getPost('template');
                $template_user->id_user=Yii::app()->request->getPost('id_user');
                if ($template_user->save()) {
                    Yii::app()->user->setFlash('success', 'Data Template User berhasil ditambahkan');
                } else {
                    print_r($template_user->getErrors());
                }
            } else if ($mode == 'delete_template') {
                $id_template_user = Yii::app()->request->getPost('id_template_user');
                $template_user = TemplateUser::model()->findByPk($id_template_user);
                $template_user->status_aktif = '1';
                $template_user->delete();
            } else if ($mode == 'aktif_template') {
                Yii::app()->db->createCommand("update template_user set status_aktif=0 where id_user='{$personil['id_user']}'")->query();
                $id_template_user = Yii::app()->request->getPost('id_template_user');
                $template_user = TemplateUser::model()->findByPk($id_template_user);
                $template_user->status_aktif = '1';
                if ($template_user->save()) {
                    Yii::app()->user->setFlash('success', 'Data Template User berhasil diaktifkan');
                } else {
                    print_r($template_user->getErrors());
                }
            }
        }
        $query_template_user = "
            select tu.*,t.nama_template 
            from template_user tu
            join template t on t.id_template=tu.id_template
            where tu.id_user='{$personil['id_user']}'
            ";
        $data_template_user = Yii::app()->db->createCommand($query_template_user)->queryAll();
        $data_template = Template::model()->findAll();
        $this->render('template', array(
            'data_template_user'=>$data_template_user,
            'data_template'=>$data_template,
            'personil' => $personil
        ));
    }

    public function actionDelete() {
        $this->layout = false;
        if (!empty($_POST['id'])) {
            $model = Personil::model()->findByPk(Yii::app()->request->getParam('id'));
            $model->delete();
            $this->redirect('read');
        }
    }

}
