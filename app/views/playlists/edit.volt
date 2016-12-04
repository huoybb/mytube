{% extends 'index.volt' %}
{% block title %}
    标签：{{ playlist.name }}-我的视频
{% endblock %}
{% block content %}
    {% include 'layouts/edit' with ['Owner':playlist] %}
{% endblock %}