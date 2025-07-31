<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_employee';

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
    protected $fillable = ['employee_id','name','is_active','email','dob','doj'];

    protected $dates = ['created_at', 'updated_at'];

}
