<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Shop extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = ['id']; // فقط id گارد بشه بقیه همه Fillable هستند.
    
    // استفاده از appends برای نمایش نام و نام خانوادگی در کنار هم
    protected $appends = ['full_name']; 


    public function getFullNameAttribute () 
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // برای دریافت ایمیل و نام کاربری فروشگاه و نمایش آن 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // برای نمایش محصولات مربوط به هر فروشگاه در صفحه خودش 
    public function products()
    {
        return $this->hasMany(Product::class); // هر فروشگاه تعداد زیادی محصول دارد.
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'owner'); // هر فروشگاه تعداد زیادی کامنت دارد.
    }
}
