<div class="page-header">
    <h1>视频：{{ movie.title }}</h1>
</div>
<div id="info">
    <div class="row">
        {% for key,value in movie.infoArray() %}
            <div class="col-md-2" align="right">
                {{ value }}
            </div>
            <div class="col-md-10">
                {{ movie.present(key) }}
            </div>
        {% endfor %}
    </div>
</div>
