<div class="page-header">
    <h1>我的视频首页</h1>
</div>

<table class="table table-hover">
    <tr>
        <td>id</td>
        <td>title</td>
        <td>channel</td>
        <td>date</td>
    </tr>
    {% for movie in movies %}
        <tr>
            <td>{{ movie.id }}</td>
            <td><a href="{{ movie.getMovieUrl() }}" target="_blank">{{ movie.title }}</a></td>
            <td><a href="{{ movie.getChannelUrl() }}" target="_blank">{{ movie.channel_title }}</a></td>
            <td>{{ movie.updated_at }}</td>
        </tr>
    {% endfor %}
</table>


