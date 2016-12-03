<h1>我的评论：<span class="badge">{{ comments.count() }}</span></h1>
<div class="row">
    <ul class="list-unstyled list-group">
        {% for commentRow in comments %}
            <li class="list-group-item">
                <div>
                    <h4>
                        <span>To：</span>
                        <button class="btn btn-primary btn-xs disabled">{{ commentRow.commentable().present('type') }}</button>
                        <a href="{{ commentRow.commentable().present('showLink') }}">
                            {{ commentRow.commentable().present('title') }}
                        </a>
                        <span>@ {{ commentRow.updated_at.diffForHumans() }}</span>
                        {#{% if gate.allows('editAndDelete',commentRow) %}#}
                            <span><a href="{{ url(['for':'comments.edit','comment':commentRow.id]) }}">编辑</a></span>
                            <span><a href="{{ url(['for':'comments.delete','comment':commentRow.id]) }}">删除</a></span>
                        {#{% endif %}#}
                    </h4>
                </div>
                <div>
                    <pre>{{commentRow.content|nl2br}}</pre>
                </div>
            </li>
        {% endfor %}
    </ul>
</div>