<h1>频道：{{ channel.title }}</h1>
{% include 'layouts/info' with ['Owner':channel] %}


<h2>视频 <span class="badge">{{ channel.movies().count() }}</span></h2>
{% include 'index/partials/movielist' with ['movies':channel.movies()]  %}
<div class="row">
    {% include 'layouts/commentList' with ['commentOwner':channel] %}
    {% include 'layouts/commentForm' with ['commentFormUrl':url(['for':'channels.addComment','channel':channel.id])] %}
</div>