{% if commentOwner.hasComments() %}
    <hr>
    <h2>Comments:</h2>
    <ul>
        {% for commentRow in commentOwner.getComments() %}
            <li>
                <div> <span>by <a href="#"> {{ commentRow.user().name }}</a></span>--<span>at: {{ commentRow.updated_at.diffForHumans() }}</span>
                    {#{% if gate.allows('editAndDelete',commentRow) %}#}
                        <span><a href="#">edit</a></span>
                        <span><a href="{{ url(['for':'comments.delete','comment':commentRow.id]) }}" class="delete">delete</a></span>
                    {#{% endif %}#}
                </div>
                <div>
                    {{commentRow.content|nl2br}}
                </div>
            </li>
        {% endfor %}
    </ul>
{% endif %}