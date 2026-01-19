<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property integer $status
 * @property integer $user_type_id
 * @property string $created_at
 * @property string $updated_at
 */
class User extends CActiveRecord
{
    public $password_repeat;
    public $old_password;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('username, email', 'required'),
            array('username, email', 'length', 'max'=>128),
            array('username', 'unique'),
            array('email', 'email'),
            array('email', 'unique'),
            array('password', 'required', 'on'=>'insert'),
            array('password', 'length', 'min'=>6, 'on'=>'insert,update'),
            array('password_repeat', 'compare', 'compareAttribute'=>'password', 'on'=>'insert,update'),
            array('first_name, last_name', 'length', 'max'=>128),
            array('status', 'numerical', 'integerOnly'=>true),
            array('status', 'in', 'range'=>array(0,1)),
            array('user_type_id', 'numerical', 'integerOnly'=>true),
            array('created_at, updated_at', 'safe'),
            array('id, username, email, first_name, last_name, status, user_type_id, created_at, updated_at', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'userType' => array(self::BELONGS_TO, 'UserType', 'user_type_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'password_repeat' => 'Repetir Contraseña',
            'email' => 'Email',
            'first_name' => 'Nombre',
            'last_name' => 'Apellidos',
            'status' => 'Estado',
            'user_type_id' => 'Tipo de Usuario',
            'created_at' => 'Fecha de Creación',
            'updated_at' => 'Última Actualización',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username,true);
        $criteria->compare('email',$this->email,true);
        $criteria->compare('first_name',$this->first_name,true);
        $criteria->compare('last_name',$this->last_name,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('updated_at',$this->updated_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id DESC',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Before save event
     */
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            // Hash password if it's changed
            if($this->isNewRecord || !empty($this->password))
            {
                $this->password = md5($this->password);
            }

            // Set timestamps
            if($this->isNewRecord)
                $this->created_at = date('Y-m-d H:i:s');
            
            $this->updated_at = date('Y-m-d H:i:s');

            return true;
        }
        return false;
    }

    /**
     * Validate password
     * @param string $password password to validate
     * @return boolean whether password is valid
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    /**
     * Get status text
     * @return string status text
     */
    public function getStatusText()
    {
        return $this->status == 1 ? 'Activo' : 'Inactivo';
    }

    /**
     * Get full name
     * @return string full name
     */
    public function getFullName()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}
