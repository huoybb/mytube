{% extends 'index.volt' %}
{% block title %}
    用户注册-我的视频
{% endblock %}
{% block content %}
    <h1>用户注册</h1>

    {{ form(url(['for':'register','method':'post'])) }}
    <div class="control-group">
        <label for="name">Username</label>
        {{ text_field('name', 'class': 'form-control') }}
        <p class="help-block">(required)</p>
    </div>
    <div class="form-group">
        <label for="email">Email address</label>
        {{ text_field('email','class':'form-control') }}
    </div>
    <div class="form-group">
        <label  for="password">Password</label>
        {{ password_field('password', 'class': 'form-control') }}
        <p class="help-block">(minimum 8 characters)</p>
    </div>
    <div class="form-group">
        <label for="repeatPassword">Repeat Password</label>
        {{ password_field('repeatPassword', 'class': 'form-control') }}
    </div>
    <div class="form-group">
        {{ submit_button('Register', 'class': 'btn btn-primary btn-large') }}
    </div>
    {{ end_form() }}
{% endblock %}
