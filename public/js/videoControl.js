var data = {
    videoTag:''
};
var myvue = new Vue({
    el:'#root',
    data:data,
    methods:{
        setVideoCurrentTime:function(position){
            var video = this.getVideoObject();
            if(position == 'head'){
                video.currentTime(0);
            }
            video.currentTime(position);
            return false;
        },
        getVideoObject:function(){
            return videojs('#my-video');
        },
        addVideoTag:function(){
            var data = {
                time:this.getVideoObject().currentTime(),
                title:this.videoTag
            };
            var url = location.href + '/addVideoTag';
            $.post(url,data,function(data){
                location.reload();
            });
            this.videoTag = '';

        },
        forward:function(){
            var video = this.getVideoObject();
            var time = video.currentTime() + 5;
            console.log(time);
            video.currentTime(time)
        },
        backward:function(){
            var video = this.getVideoObject();
            var time = video.currentTime() - 5;
            console.log(time);
            video.currentTime(time)
        }
    }
});
key('right', function() {
    myvue.forward();
});
key('left', function() {
    myvue.backward();
});