{% extends 'index.volt' %}
{% block title %}
    频道：{{ channel }}-我的视频
{% endblock %}
{% block content %}
    <h1>频道：{{ channel }}</h1>
    {% include "index/partials/movielist.volt" %}
{% endblock %}