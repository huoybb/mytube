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
            <td>{{ movie.created_at.diffForhumans() }}</td>
            <td>{{ movie.present('completed') }}</td>
            <td>
                <a href="{{ url(['for':'watchlists.want.add','movie':movie.id]) }}" class="btn btn-primary btn-xs">想看</a>
                <a href="{{ url(['for':'watchlists.doing.add','movie':movie.id]) }}" class="btn btn-primary btn-xs">在看</a>
                <a href="{{ url(['for':'watchlists.done.add','movie':movie.id]) }}" class="btn btn-primary btn-xs">看过</a>
            </td>
        </tr>
    {% endfor %}
</table>