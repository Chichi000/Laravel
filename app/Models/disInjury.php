<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class disInjury extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "dis_injury";

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
