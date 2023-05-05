<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sellers Management') }}
        </h2>
    </x-slot>


    <div class="flex justify-end">

        <a href="{{ route ('shop.create') }}" class="inline-flex items-center px-4 py-2 mt-3 ml-3 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            {{ __('Define New Sellers') }}
        </a>

    </div>

    <!-- نمایش پیام موفقیت ثبت فروشگاه -->
    <div class="bg-green-400 overflow-hidden text-gray-50 shadow-xl sm:rounded-lg p-4">
        @if($message = session('meesage'))
            {{ $message }}
        @endif
    </div>
    

    
    @if($shops->count())

    <hr class="my-4">

    <table>
        <thead>
            <tr>
                <th> #  </th>
                <th> عنوان فروشگاه </th>
                <th>  نام مدیر </th>
                <th> تلفن  </th>
                <th> ایمیل  </th>
                <th> نام کاربری  </th>
                <th> تاریخ شروع فعالیت  </th>
                <th class="col-span-2"> عملیات </th>
            </tr>
        </thead>

        
        <tbody>
            @foreach($shops as $key => $shop)

                <tr>
                    <th> {{ $key + 1 }} </th>
                    <td> {{ $shop->title }} </td>
                    <td> {{ $shop->full_name }} </td> <!--  استفاده از Appends در Shop Model  -->
                    <td> {{ $shop->telephone }} </td>
                    <td> {{ $shop->user->email ?? '-' }} </td> <!--Chain فراخوانی داده از جدول یوزر-->
                    <td> {{ $shop->user->name ?? '-' }} </td>
                    <td> {{ persianDate($shop->created_at) }} </td> <!--  تبدیل تاریخ میلادی به شمسی  -->
                    <td> 
                        <a href="{{ route ('shop.edit', $shop->id) }}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            ویرایش
                        </a>
                    </td>
                    <td> 
                        <form action="{{ route('shop.destroy', $shop->id) }}" method="post">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="delete-record inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                حذف
                            </button>

                        </form>
                    </td>
                </tr>

            @endforeach
        </tbody>

    </table>

    @endif
    




</x-app-layout>
