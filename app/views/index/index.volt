{% extends 'index.volt' %}
{% block title %}
    视频首页-我的视频
{% endblock %}
{% block content %}
    <h1>视频首页</h1>
    {% include "index/partials/movielist.volt" %}
{% endblock %}

