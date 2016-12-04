{% extends 'index.volt' %}
{% block title %}
    播放列表：{{ playlist.title }}-我的视频
{% endblock %}
{% block content %}
    <h1>播放列表：{{ playlist.title }}</h1>
    {#{% include 'layouts/info' with ['Owner':mytag] %}#}


    <h2>视频 <span class="badge">{{ playlist.movies().count() }}</span></h2>
    {% include 'index/partials/movielist' with ['movies':playlist.movies()]  %}
    <div class="row">
        {% include 'layouts/commentList' with ['commentOwner':playlist,'commentFormUrl':url(['for':'playlists.addComment','playlist':playlist.id])] %}
    </div>
{% endblock %}

