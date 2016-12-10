<h2>Tags</h2>

{{ form(tagFormUrl,'method':'post') }}
    {% include "layouts/csrf.volt" %}
    {{ tagOwner.getTagForm().render('name',['class':'form-control','rows':6]) }}
    {{ tagOwner.getTagForm().render('增加',['class':'btn btn-primary form-control']) }}
{{ endform() }}