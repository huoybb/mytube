<video
        id="my-video"
        class="video-js"
        controls
        preload="auto"
        width="1119" height="700"
        {#poster="http://video-js.zencoder.com/oceans-clip.png"#}
        data-setup='{"example_option":true}'
>
    <source src="{{ file }}" type="video/mp4" />
    {#<source src="http://video-js.zencoder.com/oceans-clip.webm" type="video/webm" />#}
    {#<source src="http://video-js.zencoder.com/oceans-clip.ogv" type="video/ogg" />#}
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
</video>