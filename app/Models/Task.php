<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

	protected $table = 'task';
	protected $primaryKey = 'id';
	protected $fillable = ['title', 'content', 'attachment', 'done_at'];

	protected $dates = ['deleted_at'];

	public $timestamps = false;
}
