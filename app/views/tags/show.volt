<h1>标签：{{ mytag.name }}</h1>
{#{% include 'layouts/info' with ['Owner':mytag] %}#}


<h2>视频 <span class="badge">{{ mytag.getTaggedObjects().count() }}</span></h2>
{% include 'index/partials/movielist' with ['movies':mytag.getTaggedObjects()]  %}
{#<div class="row">#}
    {#{% include 'layouts/commentList' with ['commentOwner':channel,'commentFormUrl':url(['for':'channels.addComment','channel':channel.id])] %}#}
{#</div>#}