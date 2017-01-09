<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebDataTempMkt extends Model
{
    protected $table = 'web_data_temp_mkt';
    public $timestamps = false;
    protected $connection = 'mysql2';
    protected $fillable = ['MKT_Code', 'MKT_Date', 'Tel_No', 'Tel_Name', 'Tel_Type', 'Tel_Etc1', 'Tel_Etc2', 'Tel_Etc3', 'Tel_Etc4', 'Tel_Etc5', 'Insert_Date'];
}
