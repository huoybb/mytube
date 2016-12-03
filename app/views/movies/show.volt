{% if file %}
    {{ partial('layouts/videojsBody') }}
    {{ partial('layouts/videojsHeader') }}
{% endif %}
<div class="page-header">
    <h1>视频：{{ movie.title }}</h1>
</div>
<div id="info">
    <div class="row">
        {% for key,value in movie.infoArray() %}
            <div class="col-md-2" align="right">
                {{ value }}:
            </div>
            <div class="col-md-10">
                {{ movie.present(key) }}
            </div>
        {% endfor %}
    </div>
</div>
<div class="row">
    <h2>评论</h2>
    {{ form(url(['for':'movies.addComment','movie':movie.id]),'method':'post') }}
        {{ commentForm.render('content',['class':'form-control','rows':6]) }}
        {{ commentForm.render('增加',['class':'btn btn-primary form-control']) }}
    {{ endform() }}
</div>
