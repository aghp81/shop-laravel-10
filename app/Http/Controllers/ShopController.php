<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
        // برای پیاده سازی میدلور CheckAdmin
        public function __construct()
        {
            // $this->middleware(['auth', 'admin']);
            // $this->middleware(['auth', 'admin'])->except(['show', 'index']);// خارج کردن دو بخش از میدلور. همه کاربران می توانند ببینند.
           // $this->middleware(['auth', 'admin'])->only(['show', 'index']);// فقط این دو بخش در میدلور ادمین باشند و سایر بخش ها را همه بتوانند ببینند.
          // $this->middleware('auth');
         // $this->middleware('admin');
        }
        
        public function index()
        {
            $shops = Shop::all();
            return view('shop.index', compact('shops'));
        }
    
        
        public function create()
        {
            $shop = new Shop; // برای اینکه اگر فرم در حالت ایجاد بود همه فیلدها رو نشون بده اگر در حالت ویرایش بود فیلد نام کاربری و ایمیل رو نشون نده.
            return view('shop.form', compact('shop')); // برای ایجاد و ویرایش فروشگاه
            // shop در حالت create ای دی ندارد.
        }
    
        
        public function store(Request $request)
        {
            // dd($request->all());
    
            // validate request for shop
            $data = $request->validate([
                'title' => 'required|between:3,100|string|unique:shops,title', // مشخص میکنیم در چه جدولی و چه ستونی یونیک باشد.
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'telephone' => 'required|string|size:11',
                'email' => 'required|email|unique:users,email',
                'username' => 'required|unique:users,name',// مشخص میکنیم در چه جدولی و چه ستونی یونیک باشد.
                'address' => 'nullable',
            ]);
    
            // create user in database
    
            $randomPass = rand (1000, 9999);// پسورد را رندم می سازد.
    
            $user = User::create([
                'name' => $request->username,
                'email' => $request->email,
                'role' => 'shop',
                'email_verified_at' => now(),
                'password' => bcrypt($randomPass), // پسورد را رندم می سازد.
            ]);
    
            // dd($data);
            // dd($user->id);
    
            // create shop in database
    
            Shop::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'telephone' => $request->telephone,
                'address' => $request->address,
            ]);
    
    
            // notify user
            $user->notify(new NewShop($user->email, $randomPass));
            // پاس دادن نام کاربری و رندم پس برای ارسال به ایمیل
    
            // redirect
    
            // return back(); // برمیگرده به روت قبلی
            // return redirect('shop'); // localhost:8000/shop
            return redirect()->route('shop.index')->withMessage( __('SUCCESS') ); // SUCCESS in fa.json
            // میتوانیم به جای withMessage بنویسم withGoli مثلا
            // ولی باید در هنگام نمایش پیام موفقیت به جای message بنویسیم gholi
    
        }
    
     
        
        public function edit(Shop $shop)
        {
            return view('shop.form', compact('shop')); // برای ایجاد و ویرایش فروشگاه
        }
    
        
        public function update(Request $request, Shop $shop)
        {
                 // validate request for update shop
                 $data = $request->validate([
                    'title' => 'required|between:3,100|string|unique:shops,title,'.$shop->id, // $shop->id = برای اینکه خطای تکراری بودن عنوان را ندهد.
                    'first_name' => 'required|string',
                    'last_name' => 'required|string',
                    'telephone' => 'required|string|size:11',
                    'address' => 'nullable',
                ]);
    
                $shop->update($data);
    
                return redirect()->route('shop.index')->withMessage( __('SUCCESS') ); // SUCCESS in fa.json
    
        
               // dd($data);
        }
    
        
        public function destroy(Shop $shop)
        {
            // dd($shop);
            // برای حذف کاربرش هم باید از دیتابیس حذف شود.
            User::where('id', $shop->user_id)->delete();
            $shop->delete(); // پاک کردن شاپ
    
            return redirect()->route('shop.index')->withMessage( __('DELETED') ); // DELETED in fa.json
    
    
        }
}
