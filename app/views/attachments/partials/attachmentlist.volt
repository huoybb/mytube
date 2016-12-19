<table class="table table-hover">
    <tr>
        <td>#</td>
        <td>名称</td>
        <td>文件</td>
        <td>所属对象</td>
        <td>创建时间</td>
        <td>操作</td>
    </tr>
    {% for file in attachments %}
        <tr>
            <td>{{ file.id }}</td>
            <td><a href="#" title="{{ file.name }}">{{ myTools.cut(file.name) }}</a></td>
            <td>{{ file.url | basename }}</td>
            <td>{{ file.attachmentable().present('showLink') }}</a></td>
            <td>{{ file.created_at.diffForhumans() }}</td>
            <td>--</td>
        </tr>
    {% endfor %}
</table>