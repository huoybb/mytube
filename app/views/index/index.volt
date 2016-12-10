{% extends 'index.volt' %}
{% block title %}
    我的视频
{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">视频</li>
    </ol>
    <h1>视频<span class="badge">{{ moviesTotal }}</span></h1>
    {% include "layouts/nav" with ['next':url(['for':'home.page','page':page.next]),'previous':url(['for':'home.page','page':page.before])] %}
    {% include "index/partials/movielist.volt" %}
{% endblock %}

