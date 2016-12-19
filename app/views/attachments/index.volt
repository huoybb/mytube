{% extends 'index.volt' %}
{% block title %}
    最新附件-我的视频
{% endblock %}
{% block content %}
    <ol class="breadcrumb">
        <li><a href="{{ url(['for':'home']) }}">首页</a></li>
        <li class="active">最新附件</li>
    </ol>
    <h1>附件<span class="badge">{{ page.total_items }}</span></h1>
    {% include "layouts/nav" with ['next':url(['for':'attachments.index.page','page':page.next]),'previous':url(['for':'attachments.index.page','page':page.before])] %}
    {% include "attachments/partials/attachmentlist" with ['attachments':page.items] %}
{% endblock %}

