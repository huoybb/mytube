{% extends 'index.volt' %}
{% block title %}
    显示评论-我的视频
{% endblock %}
{% block content %}
    <h1>评论:{{ comment.present('commentable') }}</h1>
    {% include 'layouts/info' with ['Owner':comment] %}

{% endblock %}