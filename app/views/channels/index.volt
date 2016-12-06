{% extends 'index.volt' %}
{% block title %}
    频道首页-我的视频
{% endblock %}
{% block content %}
    <h1>频道首页</h1>
    <table class="table table-hover">
        <tr>
            <th>#</th>
            <th>title</th>
            <th>视频数量</th>
            <th>列表数量</th>
            <th>获取时间</th>
        </tr>
        {% for channel in channels %}
            <tr>
                <td>{{ channel.id }}</td>
                <td><a href="{{ url(['for':'channels.show','channel':channel.id]) }}">{{ channel.title }}</a></td>
                <td>{{ channel.present('moviesCount') }}</td>
                <td>{{ channel.present('playlistsCount') }}</td>
                <td>{{ channel.created_at.diffForHumans() }}</td>
            </tr>
        {% endfor %}
    </table>
{% endblock %}



