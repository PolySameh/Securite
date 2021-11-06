<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
class Entraineur extends Model
{
	protected $fillable = ['nom', 'prenom', 'email', 'type_id'];


		public function type(){
		return $this->belongsTo(Type::class ,'type_id');
	}
}
