{% extends 'index.volt' %}
{% block title %}
    播放列表首页-我的视频
{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">列表</li>
    </ol>
    <h1>播放列表首页<span class="badge">{{ playlists | length }}</span></h1>
    {% include 'playlists/partials/lists.volt' %}
{% endblock %}
