<table class="table table-hover">
    <tr>
        <td>#</td>
        <td>名称</td>
        <td>文件</td>
        <td>大小</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    {% for file in attachments %}
        <tr>
            <td>{{ file.id }}</td>
            <td><a href="#" title="{{ file.name }}">{{ myTools.cut(file.name,20) }}</a></td>
            <td>{{ file.url | basename }}</td>
            <td>{{ file.present('getFileSize') }}</td>
            <td>{{ file.created_at.diffForhumans() }}</td>
            <td>
                {{ file.present('operation') }}
            </td>
        </tr>
    {% endfor %}
</table>