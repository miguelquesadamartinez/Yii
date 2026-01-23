<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $image
 * @property integer $author_id
 * @property string $created_at
 * @property string $updated_at
 */

class Post extends CActiveRecord
{
    public $imageFile;
    public $deleteImage = false;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'posts';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title, content', 'required'),
            array('title', 'length', 'max'=>255),
            array('slug', 'length', 'max'=>255),
            array('slug', 'unique'),
            array('slug', 'match', 'pattern'=>'/^[a-z0-9\-]+$/'),
            array('category_id', 'numerical', 'integerOnly'=>true),
            array('content, category_id', 'safe'),
            array('imageFile', 'file', 'types'=>'jpg, jpeg, png, gif', 'maxSize'=>1024*1024*5, 'allowEmpty'=>true),
            array('image, deleteImage, slug', 'safe'),
            array('id, title, slug, content, image, author_id, category_id, created_at, updated_at', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'author' => array(self::BELONGS_TO, 'User', 'author_id'),
            'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
        );
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'title' => 'Título',
            'slug' => 'URL Amigable',
            'content' => 'Contenido',
            'image' => 'Imagen',
            'imageFile' => 'Imagen',
            'author_id' => 'Autor',
            'category_id' => 'Categoría',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Última Actualización',
        );
    }

    /**
     * Genera un slug desde el título
     */
    public function generateSlug()
    {
        $slug = $this->title;
        
        // Convertir a minúsculas
        $slug = mb_strtolower($slug, 'UTF-8');
        
        // Reemplazar caracteres especiales
        $slug = str_replace(
            array('á','é','í','ó','ú','ñ','ü','à','è','ì','ò','ù'),
            array('a','e','i','o','u','n','u','a','e','i','o','u'),
            $slug
        );
        
        // Reemplazar espacios y caracteres no válidos con guiones
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        
        // Eliminar guiones al inicio y final
        $slug = trim($slug, '-');
        
        // Verificar unicidad
        $baseSlug = $slug;
        $counter = 1;
        $criteria = new CDbCriteria();
        $criteria->condition = 'slug=:slug';
        $criteria->params = array(':slug'=>$slug);
        
        if(!$this->isNewRecord) {
            $criteria->addCondition('id!=:id');
            $criteria->params[':id'] = $this->id;
        }

        while(Post::model()->find($criteria))
        {
            $slug = $baseSlug.'-'.$counter;
            $criteria->params[':slug'] = $slug;
            $counter++;
        }
        
        return $slug;
    }
    
    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->created_at = new CDbExpression('NOW()');
                $this->author_id = Yii::app()->user->id;
            }
            
            // Generar slug si está vacío
            if(empty($this->slug))
            {
                $this->slug = $this->generateSlug();
            }
            
            $this->updated_at = new CDbExpression('NOW()');
            return true;
        }
        return false;
    }

    /**
     * Get the full path to the image
     */
    public function getImagePath()
    {
        if($this->image)
            return Yii::app()->basePath.'/../uploads/posts/'.$this->image;
        return null;
    }

    /**
     * Get the URL to the image
     */
    public function getImageUrl()
    {
        if($this->image)
            return Yii::app()->baseUrl.'/uploads/posts/'.$this->image;
        return null;
    }

    /**
     * Delete the image file
     */
    public function deleteImageFile()
    {
        if($this->image)
        {
            $path = $this->getImagePath();
            if(file_exists($path))
                unlink($path);
            $this->image = null;
        }
    }
}

?>