{% if movie.playlists().count() %}
    <h2>所属列表</h2>
    <ul class="list-group">
        {% for list in movie.playlists() %}
            <li class="list-group-item">
                <span class="badge">{{ list.present('count') }}</span>
                {{ list.present('showLink') }}
            </li>
        {% endfor %}
    </ul>
{% endif %}