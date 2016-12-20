{% extends 'index.volt' %}
{% block title %}
    视频附件：{{ movie.title }}-我的视频
{% endblock %}
{% block content %}
    <h1>视频：{{ movie.present('showLink') }}</h1>
    {#{% include 'layouts/info' with ['Owner':movie] %}#}
    {% include 'layouts/attachmentlist' with ['attachments':movie.attachments()] %}
{% endblock %}