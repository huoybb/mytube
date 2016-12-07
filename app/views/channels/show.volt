{% extends 'index.volt' %}
{% block title %}
    频道：{{ channel.title }}-我的视频
{% endblock %}
{% block content %}
    {{ channel.present('breadcrumbs') }}
    <h1>频道：{{ channel.title }}</h1>
    {% include 'layouts/info' with ['Owner':channel] %}

    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="{{ url(['for':'channels.show','channel':channel.id]) }}">视频 <span class="badge">{{ channel.movies().count() }}</span></a></li>
        {% if channel.hasAnyPlaylist() %}
            <li role="presentation"><a href="{{ url(['for':'channels.showplaylists','channel':channel.id]) }}">播放列表</a></li>
        {% endif %}
    </ul>


    {% include 'index/partials/movielist' with ['movies':channel.movies()]  %}
    {% include 'layouts/commentList' with ['commentOwner':channel,'commentFormUrl':url(['for':'channels.addComment','channel':channel.id])] %}
{% endblock %}