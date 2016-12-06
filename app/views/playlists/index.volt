{% extends 'index.volt' %}
{% block title %}
    播放列表首页-我的视频
{% endblock %}
{% block content %}
    <h1>播放列表首页<span class="badge">{{ playlists | length }}</span></h1>
    {% include 'playlists/partials/lists.volt' %}
{% endblock %}
