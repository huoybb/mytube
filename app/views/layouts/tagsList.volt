<h2>Tags <a href="{{ tagOwner.present('editTagUrl') }}">修改</a></h2>

{{ form(tagFormUrl,'method':'post') }}
    {% include "layouts/csrf.volt" %}
    {{ tagOwner.getTagForm().render('name',['class':'form-control','rows':6]) }}
    {{ tagOwner.getTagForm().render('增加',['class':'btn btn-primary form-control']) }}
{{ endform() }}
<hr>
{% if tagOwner.hasTags() %}
    {% for mytag in tagOwner.getTags() %}
        <a href="{{ url(['for':'tags.show','tag':mytag.id]) }}" class="btn btn-primary btn-xs">{{ mytag.name }}({{ mytag.count }})</a>
    {% endfor %}
{% endif %}