<?php

class UserTypeController extends Controller
{
    /**
     * @var string the default layout for the views.
     */
    public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index','view','create','update','delete'),
                'users'=>array('@'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     */
    public function actionCreate()
    {
        $model=new UserType;

        if(isset($_POST['UserType']))
        {
            $model->attributes=$_POST['UserType'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success','Tipo de usuario creado exitosamente.');
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST['UserType']))
        {
            $model->attributes=$_POST['UserType'];
            if($model->save())
            {
                Yii::app()->user->setFlash('success','Tipo de usuario actualizado exitosamente.');
                $this->redirect(array('view','id'=>$model->id));
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // Check if there are users with this type
            $count = User::model()->countByAttributes(array('user_type_id'=>$id));
            if($count > 0)
            {
                Yii::app()->user->setFlash('error', 'No se puede eliminar el tipo de usuario porque hay '.$count.' usuario(s) asociado(s).');
                $this->redirect(array('view','id'=>$id));
            }
            
            $this->loadModel($id)->delete();

            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $model=new UserType('search');
        $model->unsetAttributes();
        if(isset($_GET['UserType']))
            $model->attributes=$_GET['UserType'];

        $this->render('index',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     */
    public function loadModel($id)
    {
        $model=UserType::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'La página solicitada no existe.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-type-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
