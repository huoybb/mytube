{% extends 'index.volt' %}
{% block title %}
    频道：{{ channel.title }}-我的视频
{% endblock %}
{% block content %}
    {% include 'layouts/edit' with ['Owner':channel] %}
{% endblock %}