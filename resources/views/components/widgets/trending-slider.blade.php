
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
<div {{ $attributes->merge(['class' => 'swiper trending-slider']) }}>
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      {{ $slot }}
    </div>
</div>

@push('js')
<script>
    const swiper = new Swiper('.trending-slider', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
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
