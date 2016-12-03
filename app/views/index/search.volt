{% extends 'index.volt' %}
{% block title %}
    搜索：{{ search }}-我的视频
{% endblock %}
{% block content %}
    <h1>搜索：{{ search }}</h1>
    {% include "index/partials/movielist.volt" %}
{% endblock %}