<div id="root">
    <h2>视频标签 <a href="{{ url(['for':'movies.editMovietags','movie':movie.id]) }}">修改</a></h2>
    <form @submit.prevent="addVideoTag">
        <input type="text" id="input" v-model="videoTag">
    </form>
    <div class="list-group">
        <a href="#" class="list-group-item" @click.prevent="setVideoCurrentTime('head')">片头 </a>
        {% for vidoeTag in movie.getVideoTags() if movie.hasVideoTags() %}
            <a href="#" class="list-group-item" @click.prevent="setVideoCurrentTime({{ vidoeTag.time }})">{{ vidoeTag.title }} </a>
        {% endfor %}
    </div>
</div>
<script src="/js/keymaster.js"></script>
<script src="/js/vue.js"></script>
<script src="/js/videoControl.js"></script>
