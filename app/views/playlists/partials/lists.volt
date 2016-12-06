<table class="table table-hover">
    <tr>
        <th>#</th>
        <th>列表名称</th>
        <th>频道</th>
        <th>视频数量</th>
        <th>更新时间</th>
    </tr>
    {% for playlist in playlists %}
        <tr>
            <td>{{ playlist.id }}</td>
            <td>{{ playlist.present('showLink') }}</td>
            <td>{{ playlist.present('channel') }}</td>
            <td>{{ playlist.present('count') }}</td>
            <td>{{ playlist.present('lastUpdated') }}</td>
        </tr>
    {% endfor %}
</table>