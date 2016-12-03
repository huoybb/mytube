<?php

use Phalcon\Validation;
use Phalcon\Mvc\Model\Validator\Email as EmailValidator;

class Users extends \core\myModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    public $remember_token;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $created_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $notes;

    public static function IsUserExisted($email)
    {
        return is_null(static :: findByEmail($email));
    }

    /**
     * @param $email
     * @return Users
     */
    public static function findByEmail($email)
    {
        return static :: query()
            ->where('email = :email:',['email'=>$email])
            ->execute()->getFirst();
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("mytube");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
