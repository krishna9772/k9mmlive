@props(['match'])
<div class="video-js-responsive-container vjs-hd">
    <video id="video" autoplay="true" muted preload="auto"  class="video-js vjs-default-skin" preload="none" crossorigin="true" controls width="640"
        height="268" controls>
        <source src='{{ $match->live_embed }}' type='application/x-mpegURL'>
    </video>
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {        
        var ply = videojs("video", {
            autoplay: true,
            muted: true,
            controls: true
        });
        ply.play();        
    });
</script>

