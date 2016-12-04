{% extends 'index.volt' %}
{% block title %}
    频道：{{ channel.title }}-我的视频
{% endblock %}
{% block content %}
    <h1>频道：{{ channel.title }}</h1>
    {% include 'layouts/info' with ['Owner':channel] %}


    <h2>视频 <span class="badge">{{ channel.movies().count() }}</span></h2>
    {% include 'index/partials/movielist' with ['movies':channel.movies()]  %}
    {% include 'layouts/commentList' with ['commentOwner':channel,'commentFormUrl':url(['for':'channels.addComment','channel':channel.id])] %}
{% endblock %}