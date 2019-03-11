<?php namespace Models\Entity;

use Models\GlobalModel;

class Dentist extends GlobalModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = self::DB_DENTIST;

    public $timestamps = false;

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [ 'dentist_id', 'user_name', 'password', 'address', 'phone', 'cellphone' ];

}