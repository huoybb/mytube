{% extends 'index.volt' %}
{% block title %}
    我的视频
{% endblock %}
{% block content %}
    <h1>最新视频</h1>
    {% include "index/partials/movielist.volt" %}
{% endblock %}

