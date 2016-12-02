<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="/">我的视频</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li><a href="{{ url(['for':'channels.index']) }}">频道</a></li>
                <li><a href="/tags">标签</a></li>

            </ul>


            <ul class="nav navbar-nav navbar-right">
                {% if false %}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ auth.user().name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url(['for':'myComments']) }}">最新评论</a></li>
                            <li><a href="#">统计数字</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url(['for':'logout']) }}">退出登录</a></li>
                        </ul>
                    </li>
                {% else %}
                    <li><a href="{{ url(['for':'login']) }}">登录</a></li>
                    <li><a href="{{ url(['for':'register']) }}">注册</a></li>
                {% endif %}


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form id="search-form" class="navbar-form navbar-left" role="search">
                            {{ text_field("search",'class':'form-control','placeholder':'Search','value':search) }}
                            <button type="submit" class="btn btn-default">查询</button>
                    </form>
                    <script src="/js/search.js"></script>
                </li>
            </ul>
        </div>
    </div>
</nav>