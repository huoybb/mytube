# 视频的一些设置
videojs.options.flash.swf = "/videojs/video-js.swf"
video = videojs("my-video")

#video.status = ''
video.on 'play',-> this.status = 'play'
video.on 'pause',->this.status = 'pause'

video.ready ->
  this.currentTime(movie.playtime)
  this.setInterval =>
    url = location.href + '/updatePlayTime'
    data = {'playtime':this.currentTime(),'duration':this.duration()}
    $.post url,data if this.status is 'play'
  , 5000
