{% extends 'index.volt' %}
{% block title %}
    频道播放列表：{{ channel.title }}-我的视频
{% endblock %}
{% block content %}
    {{ channel.present('breadcrumbs') }}
    <h1>频道：{{ channel.title }}</h1>
    {% include 'layouts/info' with ['Owner':channel] %}

    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{ url(['for':'channels.show','channel':channel.id]) }}">视频</a></li>
        <li role="presentation" class="active"><a href="{{ url(['for':'channels.showplaylists','channel':channel.id]) }}">播放列表 <span class="badge">{{ channel.playlists().count() }}</span></a></li>
    </ul>

    {% include 'playlists/partials/lists' with ['playlists':channel.playlists()] %}
{% endblock %}