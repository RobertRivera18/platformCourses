<?php

namespace App\Models;

use App\Enums\CourseStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'status',
        'image_path',
        'video_path',
        'welcome_message',
        'goodbye_message',
        'observation',
        'user_id',
        'level_id',
        'category_id',
        'price_id',
        'published_at',
    ];

    protected $casts = [
        'status' => CourseStatus::class,

    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function image(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->image_path ? Storage::url($this->image_path) : 'https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg';
            }
        );
    }


    protected function rating(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->reviews->count() ? round($this->reviews->avg('rating'), 1) : 5;
            }
        );
    }

    protected function dateOfAcquisition(): Attribute
    {
        return new Attribute(
            get: function () {
                return  now()->parse(DB::table('course_user')
                    ->where('course_id', $this->id)
                    ->where('user_id', auth()->id())
                    ->first()
                    ->created_at)->format('d/m/Y');
            }
        );
    }
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    public function goals()
    {
        return $this->hasMany(Goal::class);
    }


    public function requeriments()
    {
        return $this->hasMany(Requeriment::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    //Relacion mucho a muchos 

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
            ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
