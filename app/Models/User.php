<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     * ,'is_active','comments','created_by', 'updated_by' // copy and paste - fillable and logAttributes
     */
    protected $fillable = ['name', 'email', 'password', 'role'];

    
}