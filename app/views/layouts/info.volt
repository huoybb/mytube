<div id="info">
    <div class="row">
        {% for key,value in Owner.infoArray() %}
            <div class="col-md-2" align="right">
                {{ value }}:
            </div>
            <div class="col-md-10">
                {{ Owner.present(key) }}
            </div>
        {% endfor %}
    </div>
</div>