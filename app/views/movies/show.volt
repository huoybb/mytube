{% if movie.getVideoFile() %}
    {% include 'layouts/videojsBody.volt' %}
    {% include 'layouts/videojsHeader.volt' %}
{% endif %}

<div class="row">
    <div class="col-md-10">
        <h1>视频：{{ movie.title }}</h1>
        {% include 'layouts/info' with ['Owner':movie] %}
        <div class="row">
            {% include 'layouts/commentList' with ['commentOwner':movie,'commentFormUrl':url(['for':'movies.addComment','movie':movie.id])] %}
        </div>
    </div>
    <div class="col-md-2">
        {% include 'layouts/tagsList' with ['tagOwner':movie,'tagFormUrl':url(['for':'movies.addTag','movie':movie.id])] %}
    </div>
</div>
