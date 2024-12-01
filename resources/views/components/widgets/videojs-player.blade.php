@props(['match'])
<div class="video-js-responsive-container vjs-hd">
    <video id="video" autoplay="true" muted preload="auto"  class="video-js vjs-default-skin" preload="none" crossorigin="true" controls width="640"
        height="268" controls>
        <source src='{{ $match->live_embed }}' type='application/x-mpegURL'>
    </video>
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {        
        var player = videojs("video", {
            autoplay: true,
            muted: true,
            controls: true
        });
        //ply.play();        
        // Unmute the video after 1 second
        player.ready(function () {
            setTimeout(function () {
                player.muted(false); // Unmute
                //player.play();
            }, 1000);
        });
    });
</script>

