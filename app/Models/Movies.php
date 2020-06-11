<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movies extends MasterModel {
	protected $table = 'movies';
	public $timestamps = false;
}