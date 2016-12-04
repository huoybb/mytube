{% extends 'index.volt' %}
{% block title %}
    标签：{{ mytag.name }}-我的视频
{% endblock %}
{% block content %}
    <h1>标签：{{ mytag.name }}</h1>
    {% include 'layouts/info' with ['Owner':mytag] %}


    <h2>视频 <span class="badge">{{ mytag.getTaggedObjects().count() }}</span></h2>
    {% include 'index/partials/movielist' with ['movies':mytag.getTaggedObjects()]  %}
    {% include 'layouts/commentList' with ['commentOwner':mytag,'commentFormUrl':url(['for':'tags.addComment','tag':mytag.id])] %}
{% endblock %}

