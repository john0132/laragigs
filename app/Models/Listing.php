<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // public function scopeFilter($query, array $filters){
    //     dd($filters['tag']);
        
    //     if ($filters['tags'] ?? false){
    //         $query->where('tags','like','%' . request('tag') .'%');
    //     }


    // }

        protected $fillable = ['title','logo','company','location','website','email','description','tags','user_id'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if($filters['search'] ?? false) {
            //dd($filters['search']);
            $query->where('title', 'like', '%' . request('search') . '%')
            
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}