{% extends 'index.volt' %}
{% block title %}
    我的视频
{% endblock %}
{% block content %}
    <h1>视频<span class="badge">{{ moviesTotal }}</span></h1>
    {% include "index/partials/movielist.volt" %}
{% endblock %}

