{% extends 'index.volt' %}
{% block title %}
    视频标签-我的视频
{% endblock %}
{% block content %}
    <div class="row">
        <div class="col-md-10">
            <h1>标注的视频</h1>
            <table class="table table-hover">
                <tr>
                    <td>#</td>
                    <td>视频标题</td>
                    <td>最后更新</td>
                </tr>
                {% for movie in movies %}
                    <tr>
                        <td>{{ movie.id }}</td>
                        <td>{{ movie.present('showLink') }}</td>
                        <td>{{ movie.time }}</td>
                    </tr>
                {% endfor %}
            </table>
            <h1>视频标签</h1>
            <table class="table table-hover">
                <tr>
                    <td>#</td>
                    <td>title</td>
                    <td>time</td>
                    <td>视频</td>
                    <td>更新</td>
                    <td>操作</td>
                </tr>
                {% for videoTag in videotags %}
                    <tr>
                        <td>{{ videoTag.id }}</td>
                        <td>{{ videoTag.title }}</td>
                        <td>{{ videoTag.present('time') }}</td>
                        <td>{{ videoTag.present('movie') }}</td>
                        <td>{{ videoTag.present('updated_at') }}</td>
                        <td><a href="{{ url(['for':'videotags.delete','videotag':videoTag.id]) }}">删除</a> <a href="#">修改</a></td>
                    </tr>
                {% endfor %}
            </table>

        </div>
    </div>
{% endblock %}

