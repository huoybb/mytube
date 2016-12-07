{% extends 'index.volt' %}
{% block title %}
    标签：{{ mytag.name }}-我的视频
{% endblock %}
{% block content %}
    {{ mytag.present('breadcrumbs') }}
    <h1>标签：{{ mytag.name }}</h1>
    {% include 'layouts/info' with ['Owner':mytag] %}


    {% include 'tags/partials/list.volt' %}
    {% include 'tags/partials/movie.volt' %}



    {% include 'layouts/commentList' with ['commentOwner':mytag,'commentFormUrl':url(['for':'tags.addComment','tag':mytag.id])] %}
{% endblock %}

