<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pet extends Model
{
    public const Validation = [
        "pet_name" => ["required", "min:5"],
        "sex" => ["required", "min:9"],
        "kind" => ["required", "min:9"],
        "pictures" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "pets";

    protected $primaryKey = "id";

    protected $guarded = ["id"];
}
