<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;

class SectionController extends Controller
{

    // برای پیاده سازی میدلور CheckAdmin
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
        // $this->middleware(['auth', 'admin'])->except(['show', 'index']);// خارج کردن دو بخش از میدلور. همه کاربران می توانند ببینند.
       // $this->middleware(['auth', 'admin'])->only(['show', 'index']);// فقط این دو بخش در میدلور ادمین باشند و سایر بخش ها را همه بتوانند ببینند.
      // $this->middleware('auth');
     // $this->middleware('admin');
    }

    public function sections()
    {
        $sections = Section::get()->toArray();
        //dd($sections);
        return view('sections.sections')->with(compact('sections'));
    }
}
