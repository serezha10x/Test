<?php


namespace app\models;


class UserModel
{
    const TABLE_USER = 'User';
    const ID_FIELD = 'id';
    const NAME_FIELD = 'name';
    const EMAIL_FIELD = 'email';
    const PHOTO_FIELD = 'photo';
    const API_KEY_FIELD = 'api_key';

    private $id;
    private $name;
    private $email;
    private $photo;
    private $key;


    public function __construct($id, $name, $email, $photo, $key)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->photo = $photo;
        $this->key = $key;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function getKey()
    {
        return $this->key;
    }


}