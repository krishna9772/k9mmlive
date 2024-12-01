@props(['match'])
<div class="video-js-responsive-container vjs-hd">
    <video id="video" class="video-js vjs-default-skin" preload="none" crossorigin="true" controls width="640"
        height="268" controls>
    </video>
</div>


<script type="text/javascript">
    jQuery(document).ready(function () {        
        jQuery("#video").html("<source src='{{ $match->live_embed }}' type='application/x-mpegURL'>");
        var ply = videojs("video");
        ply.play();        
    });
</script>

