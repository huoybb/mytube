{% extends 'index.volt' %}
{% block title %}
    视频附件：{{ mytag.title }}-我的视频
{% endblock %}
{% block content %}
    <h1>视频：{{ mytag.present('showLink') }}</h1>
    {#{% include 'layouts/info' with ['Owner':movie] %}#}
    {% include 'layouts/attachmentlist' with ['attachments':mytag.attachments()] %}
{% endblock %}