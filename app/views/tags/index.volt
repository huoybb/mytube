{% extends 'index.volt' %}
{% block title %}
    我的标签-我的视频
{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">标签</li>
    </ol>
    <h1>我的标签<span class="badge">{{ tags | length }}</span></h1>
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>name</th>
            <th>数量</th>
            <th>时间</th>
        </tr>
        {% for mytag in tags %}
            <tr>
                <td>{{ mytag.id }}</td>
                <td><a href="{{ url(['for':'tags.show','tag':mytag.id]) }}">{{ mytag.name }}</a></td>
                <td>{{ mytag.present('count') }}</td>
                <td>{{ mytag.created_at.diffForHumans() }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}
