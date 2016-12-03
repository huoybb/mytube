<table class="table table-hover">
    <tr>
        <td>id</td>
        <td>title</td>
        <td>channel</td>
        <td>created</td>
        <td>updated</td>
        <td>completed</td>
    </tr>
    {% for movie in movies %}
        <tr>
            <td>{{ movie.id }}</td>
            <td><a href="{{ url(['for':'movies.show','movie':movie.id]) }}">{{ movie.title }}</a></td>
            <td><a href="{{ url(['for':'channels.show','channel':movie.channel_id]) }}">{{ movie.channel_title }}</a></td>
            <td>{{ movie.created_at.diffForhumans() }}</td>
            <td>{{ movie.updated_at.diffForhumans() }}</td>
            <td>{{ movie.present('completed') }}</td>
        </tr>
    {% endfor %}
</table>