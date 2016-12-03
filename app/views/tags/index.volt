<h1>标签首页</h1>
<table class="table table-hover">
    <tr>
        <th>#</th>
        <th>name</th>
        <th>数量</th>
        <th>时间</th>
    </tr>
    {% for mytag in tags %}
        <tr>
            <td>{{ mytag.id }}</td>
            <td><a href="{{ url(['for':'tags.show','tag':mytag.id]) }}">{{ mytag.name }}</a></td>
            <td>{{ mytag.present('count') }}</td>
            <td>{{ mytag.created_at.diffForHumans() }}</td>
        </tr>
    {% endfor %}
</table>