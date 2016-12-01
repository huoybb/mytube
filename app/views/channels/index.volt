<h1>我的视频首页</h1>
<table class="table table-hover">
    <tr>
        <th>#</th>
        <th>title</th>
        <th>获取时间</th>
        <th>操作</th>
    </tr>
    {% for channel in channels %}
        <tr>
            <td>{{ channel.id }}</td>
            <td><a href="{{ url(['for':'channels.show','channel':channel.id]) }}">{{ channel.title }}</a></td>
            <td>{{ channel.created_at.diffForHumans() }}</td>
            <td>--</td>
        </tr>
    {% endfor %}
</table>