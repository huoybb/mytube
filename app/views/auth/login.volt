<h1>用户注册</h1>

{{ form(url(['for':'login','method':'post'])) }}
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
        {{ submit_button('登录', 'class': 'btn btn-primary btn-large') }}
        <a href="#" class="btn btn-primary btn-large">忘记密码</a>
    </div>
{{ end_form() }}