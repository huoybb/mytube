<h1>频道：{{ channel.title }}</h1>
{% include 'layouts/info' with ['Owner':channel] %}


<h2>视频 <span class="badge">{{ channel.movies().count() }}</span></h2>
{% include 'index/partials/movielist' with ['movies':channel.movies()]  %}
