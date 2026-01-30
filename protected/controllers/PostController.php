<?php

class PostController extends Controller
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
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
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
     * Displays a particular model by slug or id.
     * @param string $slug the slug of the model to be displayed
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($slug=null, $id=null)
    {
        if($slug !== null)
        {
            $model = Post::model()->findByAttributes(array('slug'=>$slug));
            if($model === null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        else if($id !== null)
        {
            $model = $this->loadModel($id);
        }
        else
        {
            throw new CHttpException(400,'Invalid request.');
        }
        
        // Verificar que el usuario actual sea el autor del post
        if($model->author_id != Yii::app()->user->id)
        {
            throw new CHttpException(403,'No tienes permiso para ver este post.');
        }
        
        $this->render('view',array(
            'model'=>$model,
        ));
    }

    /**
     * Creates a new model.
     */
    public function actionCreate()
    {
        $model=new Post;
        $model->author_id = Yii::app()->user->id;

        if(isset($_POST['Post']))
        {
            $model->attributes=$_POST['Post'];
            
            // Handle image upload
            $model->imageFile = CUploadedFile::getInstance($model,'imageFile');
            
            if($model->validate())
            {
                if($model->imageFile)
                {
                    // Create upload directory if it doesn't exist
                    $uploadPath = Yii::app()->basePath.'/../uploads/posts/';
                    if(!is_dir($uploadPath))
                        mkdir($uploadPath, 0755, true);
                    
                    // Generate unique filename
                    $fileName = time().'_'.uniqid().'.'.$model->imageFile->extensionName;
                    
                    // Save file
                    if($model->imageFile->saveAs($uploadPath.$fileName))
                    {
                        $model->image = $fileName;
                    }
                }
                
                if($model->save(false))
                {
                    Yii::app()->user->setFlash('success','Post creado exitosamente.');
                    $this->redirect(array('view','slug'=>$model->slug));
                }
            }
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);
        
        // Verificar que el usuario actual sea el autor del post
        if($model->author_id != Yii::app()->user->id)
        {
            throw new CHttpException(403,'No tienes permiso para editar este post.');
        }
        
        $oldImage = $model->image;

        if(isset($_POST['Post']))
        {
            $model->attributes=$_POST['Post'];
            
            // Check if user wants to delete current image
            if(isset($_POST['Post']['deleteImage']) && $_POST['Post']['deleteImage'])
            {
                $model->deleteImageFile();
                $oldImage = null;
            }
            
            // Handle image upload
            $model->imageFile = CUploadedFile::getInstance($model,'imageFile');
            
            if($model->validate())
            {
                if($model->imageFile)
                {
                    // Delete old image if exists
                    if($oldImage)
                    {
                        $oldPath = Yii::app()->basePath.'/../uploads/posts/'.$oldImage;
                        if(file_exists($oldPath))
                            unlink($oldPath);
                    }
                    
                    // Create upload directory if it doesn't exist
                    $uploadPath = Yii::app()->basePath.'/../uploads/posts/';
                    if(!is_dir($uploadPath))
                        mkdir($uploadPath, 0755, true);
                    
                    // Generate unique filename
                    $fileName = time().'_'.uniqid().'.'.$model->imageFile->extensionName;
                    
                    // Save file
                    if($model->imageFile->saveAs($uploadPath.$fileName))
                    {
                        $model->image = $fileName;
                    }
                }
                else if(!$model->deleteImage)
                {
                    // Restore old image if no new upload and not deleting
                    $model->image = $oldImage;
                }
                
                if($model->save(false))
                {
                    Yii::app()->user->setFlash('success','Post actualizado exitosamente.');
                    $this->redirect(array('view','slug'=>$model->slug));
                }
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            $model = $this->loadModel($id);
            
            // Verificar que el usuario actual sea el autor del post
            if($model->author_id != Yii::app()->user->id)
            {
                throw new CHttpException(403,'No tienes permiso para eliminar este post.');
            }
            
            // Delete image if exists
            if($model->image)
            {
                $imagePath = $model->getImagePath();
                if(file_exists($imagePath))
                    unlink($imagePath);
            }
            
            $model->delete();

            if(!isset($_GET['ajax']))
            {
                Yii::app()->user->setFlash('success','Post eliminado exitosamente.');
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $criteria = new CDbCriteria();
        $criteria->order = 't.created_at DESC';
        $criteria->with = array('author');
        
        // Aplicar filtro solo si viene el parámetro
        if(isset($_GET['palabra']) && !empty($_GET['palabra']))
        {
            $criteria->condition = 't.title LIKE :palabra';
            $criteria->params = array(':palabra'=>'%'.$_GET['palabra'].'%');
        }
        
        $dataProvider=new CActiveDataProvider('Post', array(
            'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * @param integer $id the ID of the model to be loaded
     * @return Post the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=Post::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Post $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
