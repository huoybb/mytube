{% extends 'index.volt' %}
{% block title %}
    视频：{{ movie.title }}-我的视频
{% endblock %}
{% block content %}
    {% include 'layouts/edit' with ['Owner':movie] %}
{% endblock %}