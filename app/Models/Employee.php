<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name','mobile','email','salary', 'designation', 'joining_date', 'department','uan','pan','pf','esic','paddress','caddress','dob','bank_name', 'account_no', 'ifsc'];
    public $timestamps = true; // default — can be omitted


}
