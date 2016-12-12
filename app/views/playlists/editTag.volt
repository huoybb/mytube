{% extends 'index.volt' %}
{% block title %}
    编辑标签：{{ playlist.title }}-我的视频
{% endblock %}
{% block content %}
    {% include 'layouts/editTag' with ['tagOwner':playlist] %}
{% endblock %}

