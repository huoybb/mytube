{% if file %}
    {% include 'layouts/videojsBody.volt' %}
    {% include 'layouts/videojsHeader.volt' %}
{% endif %}
<div class="page-header">
    <h1>视频：{{ movie.title }}</h1>
</div>
{% include 'layouts/info' with ['Owner':movie] %}
<div class="row">
    {% include 'layouts/commentList' with ['commentOwner':movie] %}
    {% include 'layouts/commentForm' with ['commentFormUrl':url(['for':'movies.addComment','movie':movie.id])] %}
</div>
