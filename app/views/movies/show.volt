{% extends 'index.volt' %}
{% block title %}
    视频：{{ movie.title }}-我的视频
{% endblock %}
{% block content %}
    {% if movie.getVideoFile() %}
        {% include 'layouts/videojsBody.volt' %}
        {% include 'layouts/videojsHeader.volt' %}
    {% endif %}

    <div class="row">
        <div class="col-md-10">
            <h1>视频：{{ movie.title }}</h1>
            {% include 'layouts/info' with ['Owner':movie] %}
            {% include 'layouts/commentList' with ['commentOwner':movie,'commentFormUrl':url(['for':'movies.addComment','movie':movie.id])] %}
        </div>
        <div class="col-md-2">
            {% include 'layouts/tagsList' with ['tagOwner':movie,'tagFormUrl':url(['for':'movies.addTag','movie':movie.id])] %}
            {% include 'movies/partials/playlists.volt' %}
        </div>
    </div>
{% endblock %}

