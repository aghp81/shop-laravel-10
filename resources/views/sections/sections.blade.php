<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Section Management') }}
        </h2>
    </x-slot>


    <div class="flex justify-end">

        <a href="{{ route ('shop.create') }}" class="inline-flex items-center px-4 py-2 mt-3 ml-3 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
            {{ __('Define New Sellers') }}
        </a>

    </div>

    <!-- نمایش پیام موفقیت ثبت فروشگاه -->
    <!-- نمایش پیام های موفقیت -->
    @if($message = session('message'))
        <div class="text-gray-50 bg-green-400 overflow-hidden shadow-xl sm:rounded-lg p-4 mb-6">
            {{ $message }}
        </div>
    @endif
    

    
    
    <hr class="my-4">

    <table>
        <thead>
            <tr>
                <th> #  </th>
                <th> عنوان بخش </th>
                <th> وضعیت </th>
                
                
                <th> عملیات </th>
            </tr>
        </thead>

        
        <tbody>
            @foreach($sections as $key => $section)

                <tr>
                    <th> {{ $key + 1 }} </th>
                    <td> {{ $section['name'] }} </td>
                    <td>
                        @if($section['status'] == 1)
                            <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)">فعال</a>
                            @else
                            <a class="updateSectionStatus" id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}" href="javascript:void(0)">غیرفعال</a>
                            @endif
                    </td> <!--  فعال و غیرفعال کردن بخش  -->
                    
                    <td>
                        <a href="{{ url('section/view-vendor-details/'.$section['id']) }}">مستند</a>
                    </td>
                    
                </tr>

            @endforeach
        </tbody>

    </table>

    




</x-app-layout>
