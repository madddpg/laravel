<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;




class Jobs extends Model {

    protected $table = 'jobs';   
    protected $primaryKey = 'job_id'; 
    public $incrementing = true; 
    protected $keyType = 'int';  
    protected $fillable = [
        'title', 'location', 'salary'
    ];

    public $timestamps = false;
}

?>
