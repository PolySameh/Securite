<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Coach extends Model
{
	protected $fillable = ['nom', 'prenom', 'email'];

	public function type(){
		return $this->belongsTo(Type::class);
	}
}
