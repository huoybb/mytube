<h1>频道：{{ channel.title }}</h1>
<div class="row">
    <div class="col-md-2" align="right">
        Youtbue:
    </div>
    <div class="col-md-10">
        <a href="{{ channel.present('YoutubeLink') }}">链接</a>
    </div>
</div>

<h2>视频</h2>
{% include 'index/partials/movielist' with ['movies':channel.movies()]  %}
