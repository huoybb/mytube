{% extends 'index.volt' %}
{% block title %}
    编辑视频标签：{{ movie.title }}-我的视频
{% endblock %}
{% block content %}
    <div class="row">
        {{ movie.present('breadcrumbs') }}
        <div class="col-md-10">
            <h1>视频标签：{{ movie.present('showLink') }}</h1>
            <table class="table table-hover">
                <tr>
                    <td>#</td>
                    <td>title</td>
                    <td>time</td>
                    <td>操作</td>
                </tr>
                {% for videoTag in movie.getVideoTags() if movie.hasVideotags() %}
                    <tr>
                        <td>{{ videoTag.id }}</td>
                        <td>{{ videoTag.title }}</td>
                        <td>{{ videoTag.present('time') }}</td>
                        <td><a href="{{ url(['for':'videotags.delete','videotag':videoTag.id]) }}">删除</a> <a href="#">修改</a></td>
                    </tr>
                {% endfor %}
            </table>
        </div>
    </div>
{% endblock %}

