{% if mytag.getTaggedObjects().count() %}
    <h2>视频 <span class="badge">{{ mytag.getTaggedObjects().count() }}</span></h2>
    {% include 'index/partials/movielist' with ['movies':mytag.getTaggedObjects()]  %}
{% endif %}