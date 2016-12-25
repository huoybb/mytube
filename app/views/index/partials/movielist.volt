<table class="table table-hover">
    <tr>
        <td>id</td>
        <td>视频</td>
        <td>频道</td>
        <td>获取</td>
        <td>观看</td>
        <td>操作</td>
    </tr>
    {% for movie in movies %}
        <tr>
            <td>{{ movie.id }}</td>
            <td><a href="{{ url(['for':'movies.show','movie':movie.id]) }}" title="{{ movie.title }}">{{ myTools.cut(movie.title) }}</a></td>
            <td><a href="{{ url(['for':'channels.show','channel':movie.channel_id]) }}">{{ movie.channel_title }}</a></td>
            <td>{{ movie.present('created_at') }}</td>
            <td>{{ movie.present('completed') }}</td>
            <td>{{ movie.present('addToWatchlistLinks') }}</td>
        </tr>
    {% endfor %}
</table>