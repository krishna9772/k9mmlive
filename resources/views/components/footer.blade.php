<!-- Footer -->
<div class="flex py-2 align-middle social-links bg-neutral-100 dark:bg-gray-900">
    <div class="flex justify-center mx-auto space-x-6 text-dark-color dark:text-gray-300">
        @foreach ( App\Helpers\AppHelper::socialLinks() as $link)
            <div>
                <a href="{{ $link->link }}" target="_blank" class="hover:text-gray-600">
                    <x-icon name="{{ $link->icon }}"  width="30" height="30" />
                </a>
            </div>
        @endforeach
    </div>
</div>
<div id="footer" class="items-center justify-between px-6 py-5 text-sm text-white dark:text-gray-400 bg-dark-color dark:bg-gray-800">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-center px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            © {{ date("Y") }} <a href="{{ url('/') }}">K9Win</a>. All Rights Reserved.
        </div>
    </div>
</div>
