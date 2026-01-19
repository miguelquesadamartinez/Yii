<?php

/**
 * This is the model class for table "posts".
 *
 * The followings are the available columns in table 'posts':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $author_id
 * @property string $created_at
 * @property string $updated_at
 */

class Post extends CActiveRecord
{
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
            array('content', 'safe'),
            array('id, title, content, author_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
            'content' => 'Contenido',
            'author_id' => 'Autor',
            'category_id' => 'Categoría',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Última Actualización',
        );
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
            $this->updated_at = new CDbExpression('NOW()');
            return true;
        }
        return false;
    }
}

?>