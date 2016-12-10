# 前后导航键的设置，方便浏览
if $('.next a').length
  key 'right',->
    location.href = $('.next a').attr('href')
if $('.previous a').length
  key 'left',->
    location.href = $('.previous a').attr('href')