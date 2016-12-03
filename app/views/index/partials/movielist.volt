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
            <td><a href="{{ url(['for':'movies.show','movie':movie.id]) }}">{{ movie.title }}</a></td>
            <td><a href="{{ url(['for':'channels.show','channel':movie.channel_id]) }}">{{ movie.channel_title }}</a></td>
            <td>{{ movie.updated_at.diffForhumans() }}</td>
        </tr>
    {% endfor %}
</table>