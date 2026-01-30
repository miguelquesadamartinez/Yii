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
    private $_oldPassword;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'users';
    }
    
    /**
     * After find - store the original password
     */
    protected function afterFind()
    {
        parent::afterFind();
        $this->_oldPassword = $this->password;
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
            // Contraseña solo requerida al crear
            array('password', 'required', 'on'=>'insert'),
            array('password_repeat', 'required', 'on'=>'insert'),
            // Validar en beforeValidate si hay contraseña
            array('first_name, last_name', 'length', 'max'=>128),
            array('status', 'numerical', 'integerOnly'=>true),
            array('status', 'in', 'range'=>array(0,1)),
            array('user_type_id', 'numerical', 'integerOnly'=>true),
            array('created_at, updated_at, password, password_repeat', 'safe'),
            array('id, username, email, first_name, last_name, status, user_type_id, created_at, updated_at', 'safe', 'on'=>'search'),
        );
    }
    
    /**
     * Before validate
     */
    protected function beforeValidate()
    {
        if(parent::beforeValidate())
        {
            // Validar contraseña solo si se proporciona
            if(!empty($this->password))
            {
                if(strlen($this->password) < 6)
                {
                    $this->addError('password', 'La contraseña debe tener al menos 6 caracteres.');
                    return false;
                }
                if($this->password !== $this->password_repeat)
                {
                    $this->addError('password_repeat', 'Las contraseñas no coinciden.');
                    return false;
                }
            }
            return true;
        }
        return false;
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
     * Verifica si el usuario es administrador
     * @return boolean
     */
    public function isAdmin()
    {
        return $this->user_type_id == 1;
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
        $criteria->compare('user_type_id',$this->user_type_id);
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
            if(!empty($this->password))
            {
                $this->password = md5($this->password);
            }
            else if(!$this->isNewRecord)
            {
                // Mantener la contraseña existente si no se proporciona una nueva
                $this->password = $this->_oldPassword;
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
