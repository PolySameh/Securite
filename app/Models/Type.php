<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Entraineur;
class Type extends Model
{
	protected $fillable = ['name', 'price',];


	public function entraineur(){
		return $this->hasMany(Entraineur::class);
	}
}
