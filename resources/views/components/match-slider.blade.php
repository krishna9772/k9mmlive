@push('styles')
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endpush

<!-- Slider main container -->
<div {{ $attributes->merge(['class' => 'swiper match-slider']) }} style="padding-bottom:40px;">
    <!-- Additional required wrapper -->
    <div class="flex items-stretch swiper-wrapper">
      <!-- Slides -->
      {{ $slot }}
    </div>
    <!-- If we need pagination -->
    <div class="flex flex-row justify-center swiper-pagination mt-5 pe-4"></div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

@push('js')
<script>
    const match_swiper = new Swiper('.match-slider', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    initialSlide:2,
    slidesPerView: 2,
    spaceBetween: 10,
    autoHeight:true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    });
    </script>
@endpush
