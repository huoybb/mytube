{% extends 'index.volt' %}
{% block title %}
    在看的视频
{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">在看的视频</li>
    </ol>
    <h1>视频<span class="badge">{{ page.total_items }}</span></h1>
    {% include "layouts/nav" with ['next':url(['for':'watchlists.want.page','page':page.next]),'previous':url(['for':'watchlists.want.page','page':page.before])] %}
    {% include "index/partials/movielist" with ['movies':page.items] %}
{% endblock %}

