<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'description', 'type_area_id'];

    protected $searchableFields = ['*'];

    public function typeArea()
    {
        return $this->belongsTo(TypeArea::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
