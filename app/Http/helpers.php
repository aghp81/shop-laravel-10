<?php

// تبدیل تاریخ میلادی به شمسی 

function persianDate($enDate)
{
    $faDate = \Morilog\Jalali\Jalalian::fromCarbon($enDate);
    return $faDate->format('Y-m-d');
}



// اپلود تصاویر

function short($string, $max=50)
{
    return mb_strlen($string) > $max ? mb_substr($string, 0, $max).'...' : $string;
}

function upload($newFile)
{
    $filename = randomSHA().".".$newFile->getClientOriginalExtension();
    $newFile->move(base_path('storage/app/public'), $filename);
    return "storage/$filename";
}

function deleteFile($path)
{
    \File::delete($path);
}

function randomSHA()
{
    return bin2hex(random_bytes(10));
}

// نمایش ای دی فروشگاهی که لاگین کرده.
function currentShopId() 
{ 
    $shop = App\Models\Shop::where('user_id', auth()->id())->firstOrFail(); // اونجایی که آی دی کاربر با آی دی شخصی که لاگین کرده برابره
    return $shop->id ?? 0; // اگر ای دی را پیدا کرد که کرد اگر نکرد 0 یعنی هیچ کدوم رو برمی گردونه
}


// هر فروشنده ای فقط بتواند محصول مربوط به خودش را ویرایش یا حذف کند.
function checkPolicy($case, $object) // یک تایپ رو به عنوان ورودی میگیره و یه آبجکت
{
    $user = auth()->user();
    if (!$user->role == 'admin') {
        switch ($case) {
            case 'product':
                if ($object->shop_id != currentShopId()) {
                    abort(404);
                }
                break;
            
            default:
            abort(404);
                break;
        }
    }
    
}

// اکتیو بودن منوها هنگام انتخاب صفحه
function currentLandingPage()
{
    if (request()->routeIs('landing')) {
        $route = request()->route();
        return $route->parameters['page'];
        // dd(request()->route());
        return 'products';
    }
}


// نمایش تعداد محصل در سبد خرید در منو
function cartCount()
{
    $user = auth()->user(); // باید ایتدا ببینیم کاربر لاگین کرده که بتوان سبد خرید او را بررسی کرد.
    $count = 0;
    if ($user) {
        $cart = App\Models\Cart::where('user_id', $user->id)->where('finished', 0)->first(); // اگر کاربری داشتیم کارت رو پیدا کنه.
        if ($cart) {
            $count = App\Models\CartItem::where('cart_id', $cart->id)->sum('count'); // جمع اعداد ستون count را نمایش دهد.
        }
    }
    return $count;
}