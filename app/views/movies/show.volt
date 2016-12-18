{% extends 'index.volt' %}
{% block title %}
    视频：{{ movie.title }}-我的视频
{% endblock %}
{% block content %}
    {% if movie.getVideoFile() %}
        <div class="container">
            <div class="col-md-9">
                {% include 'layouts/videojsBody.volt' %}
                {% include 'layouts/videojsHeader.volt' %}
            </div>
            <div class="col-md-3">
                {% include 'layouts/videotags.volt' %}
            </div>
        </div>
    {% endif %}

    <div class="row">
        {{ movie.present('breadcrumbs') }}
        <div class="col-md-10">
            <h1>视频：{{ movie.title }}</h1>
            {% include 'layouts/info' with ['Owner':movie] %}
            {% include 'movies/partials/attachments.volt' %}
            {% include 'layouts/commentList' with ['commentOwner':movie,'commentFormUrl':url(['for':'movies.addComment','movie':movie.id])] %}
        </div>
        <div class="col-md-2">
            {% include 'layouts/tagsList' with ['tagOwner':movie,'tagFormUrl':url(['for':'movies.addTag','movie':movie.id])] %}
            {% include 'movies/partials/playlists.volt' %}
        </div>
    </div>
{% endblock %}