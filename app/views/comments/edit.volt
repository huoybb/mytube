{% extends 'index.volt' %}
{% block title %}
    评论修改-我的视频
{% endblock %}
{% block content %}
    <h1>修改评论</h1>
    <div class="col-md-2">评论对象：</div>
    <div class="col-md-10">{{ comment.commentable().present('type') }}{{ comment.commentable().present('showLink') }}</div>
    <div class="col-md-2">评论者：</div>
    <div class="col-md-10">{{ comment.user().name }}</div>
    {% include 'layouts/edit' with ['Owner':comment] %}
{% endblock %}