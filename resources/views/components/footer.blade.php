<!-- Footer -->

<div id="footer" class="items-center justify-between px-6 py-5 text-sm text-white dark:text-gray-400 bg-dark-color dark:bg-gray-800">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 gap-4 mt-10 mb-10 ">
            <div>
                <x-application-mark class="block w-auto h-9 "  />
            </div>
            <div>
                <div>
                    <div>
                        <a href="{{ url('/') }}" class="hover:text-red-600">{{ __("Home") }}</a>
                    </div>
                    <div>
                        <a href="{{ url('/live-match') }}" class="hover:text-red-600">{{ __("Live Match") }}</a>
                    </div>                    
                    <div>
                        <a href="{{ url('/live-schedule') }}" class="hover:text-red-600">{{ __("Live Schedule") }}</a>
                    </div>                    
                </div>                
            </div>
            <div>
                <div>                                        
                    <div>
                        <a href="{{ url('/category/sport-articles') }}" class="hover:text-red-600">{{ __("Sport Articles") }}</a>
                    </div>
                    <div>
                        <a href="{{ url('/category/sport-news') }}" class="hover:text-red-600">{{ __("Sport News") }}</a>
                    </div>                                        
                    <div>
                        <a href="{{ url('/category/videos') }}" class="hover:text-red-600">{{ __("Videos") }}</a>
                    </div>                    
                    <div>
                        <a href="{{ url('/about-us') }}" class="hover:text-red-600">{{ __("About Us") }}</a>
                    </div>
                    <div>
                        <a href="{{ url('/about-us/advertise') }}" class="hover:text-red-600">{{ __("Advertise") }}</a>
                    </div>
                    
                </div> 
            </div>
            <div>
            </div>
          </div>
          <div class="flex mb-3">
            @foreach ( App\Helpers\AppHelper::socialLinks() as $link)                    
                <a href="{{ $link->link }}" target="_blank" class="hover:text-red-600 mr-3">
                    <x-icon name="{{ $link->icon }}"  width="30" height="30" />                            
                </a>                    
            @endforeach
          </div>
        <div class="flex justify-center px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            © {{ date("Y") }} <a href="{{ url('/') }}">K9Win</a>. {{ __("All Rights Reserved.") }}            
        </div>        
    </div>
</div>
