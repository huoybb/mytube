<div class="container">
    <p>{{ flash.output() }}</p>
    {{ form("method": "post") }}
    {% for item in Owner.getForm().fields %}
        <div class="form-group">
            {{ item }}:{{ Owner.getForm().render(item,['class':'form-control']) }}<br/>
        </div>
    {% endfor %}
    <div class="form-group">
        {{ Owner.getForm().render('修改',['class':'btn btn-primary form-control']) }}
    </div>
    {{ endform() }}

</div>