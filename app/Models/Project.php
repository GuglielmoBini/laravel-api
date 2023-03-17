<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'project_url', 'image_url', 'type_id'];

    // assegno relazione con i tipi
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    // assegno relazione con le tecnologie
    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function getDate($date_column, $format = 'd/m/y')
    {
        $date = $this->$date_column;
        return Carbon::create($date)->format($format);
    }
}
