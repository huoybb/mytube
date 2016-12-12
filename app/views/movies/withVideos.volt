{% extends 'index.volt' %}
{% block title %}
    我的视频
{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">视频</li>
    </ol>
    <h1><a href="{{ url(['for':'home']) }}">视频</a> 含视频<span class="badge">{{ page.total_items }}</span></h1>
    {% include "layouts/nav" with ['next':url(['for':'movies.index.withVideos.page','page':page.next]),'previous':url(['for':'movies.index.withVideos.page','page':page.before])] %}
    {% include "index/partials/movielist" with ['movies':page.items] %}
{% endblock %}

