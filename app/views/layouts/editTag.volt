<div class="row">
    {{ tagOwner.present('breadcrumbs') }}
    <div class="col-md-10">
        <h1>标签：{{ tagOwner.present('showLink') }}</h1>
        <table class="table table-hover">
            <tr>
                <td>#</td>
                <td>name</td>
                <td>操作</td>
            </tr>
            {% for mytag in tagOwner.getTags() if tagOwner.hasTags() %}
                <tr>
                    <td>{{ mytag.id }}</td>
                    <td>{{ mytag.name }}</td>
                    <td>{{ tagOwner.present().deleteTag(mytag) }} </td>
                </tr>
            {% endfor %}
        </table>
    </div>
</div>