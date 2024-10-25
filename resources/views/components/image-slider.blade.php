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
<div {{ $attributes->merge(['class' => 'swiper image-slider']) }}>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      {{ $slot }}
    </div>
    <!-- If we need pagination -->
    <div class="flex flex-row justify-end swiper-pagination pe-4"></div>
    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>

@push('js')
<script>
    const swiper = new Swiper('.image-slider', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

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
