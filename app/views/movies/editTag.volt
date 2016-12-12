{% extends 'index.volt' %}
{% block title %}
    编辑标签：{{ movie.title }}-我的视频
{% endblock %}
{% block content %}
    {% include 'layouts/editTag' with ['tagOwner':movie] %}
{% endblock %}

