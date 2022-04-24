<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    public const VALIDATION_RULES = [
        "service_name" => ["required", "min:1"],
        "cost" => ["required", "numeric", "min:1"],
        "images" => ["required", "image", "mimes:jpg,png,jpeg,gif", "max:5048"],
    ];

    use HasFactory;

    use SoftDeletes;

    protected $dates = ["deleted_at"];

    protected $table = "services";

    protected $fillable = ["service_name", "cost", "images"];

    protected $primaryKey = "id";


}
