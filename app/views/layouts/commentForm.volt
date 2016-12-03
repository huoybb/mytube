{{ form(commentFormUrl,'method':'post') }}
        {{ commentForm.render('content',['class':'form-control','rows':6]) }}
        {{ commentForm.render('增加',['class':'btn btn-primary form-control']) }}
    {{ endform() }}