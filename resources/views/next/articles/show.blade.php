@extends('next.layouts.app')
@section('title'){{setting('web_name', 'MrCoder技术栈').'|'.$article->title}}@endsection
@section('keywords'){{setting('web_name', 'MrCoder技术栈').','.$article->keywords}}@endsection
@section('description'){{setting('web_name', 'MrCoder技术栈').','.$article->description}}@endsection

@section('content')
    @parent
    <div id="content" class="content">
        <div id="posts" class="posts-expand">
            <article class="post post-type-normal" itemscope="" itemtype="">
                <div class="post-block">
                    <link itemprop="mainEntityOfPage"
                          href="{{ route('articles.show', $article->id) }}">
                    <span hidden itemprop="author" itemscope="{{setting('web_name', 'MrCoder技术栈')}}" itemtype="{{setting('web_name', 'MrCoder技术栈')}}">
      <meta itemprop="name" content="{{$article->title}}">
      <meta itemprop="description" content="{{$article->description}}">
      <meta itemprop="image" content="/images/avatar.jpg">
    </span>
                    <span hidden itemprop="publisher" itemscope="{{setting('web_name', 'MrCoder技术栈')}}"
                          itemtype="{{setting('web_name', 'MrCoder技术栈')}}">
      <meta itemprop="name" content="{{$article->title}}">
    </span>
                    <header class="post-header">
                        <h1 class="post-title" itemprop="name headline">{{$article->title}}</h1>
                        <div class="post-meta">
          <span class="post-time">
              <span class="post-meta-item-icon">
                <i class="fa fa-calendar-o"></i>
              </span>
                <span class="post-meta-item-text">发表于</span>
              <time title="创建于" itemprop="dateCreated datePublished" datetime="{{$article->created_at_date}}">
                {{$article->created_at_date}}
              </time>
          </span>
                            <span class="post-category">
              <span class="post-meta-divider">|</span>
              <span class="post-meta-item-icon">
                <i class="fa fa-folder-o"></i>
              </span>
                <span class="post-meta-item-text">分类于</span>
                <span itemprop="about" itemscope="" itemtype="">
                  <a href="{{route('cates')}}/{{$article->cate_id}}" itemprop="url" rel="index">
                    <span itemprop="name">{{$article->cates}}</span>
                  </a>
                </span>
            </span>
                            <span class="post-comments-count">
                <span class="post-meta-divider">|</span>
                <span class="post-meta-item-icon">
                  <i class="fa fa-comment-o">{{$count}}</i>
                </span>
                <a href="{{ route('articles.show', $article->id) }}/#comments" itemprop="discussionUrl">
                  <span class="post-comments-count valine-comment-count"
                        data-xid="{{ route('articles.show', $article->id) }}"
                        itemprop="commentCount"></span>
                </a>
              </span>
                            <span class="post-meta-divider">|</span>
                            <span class="page-pv"><i class="fa fa-file-o">阅读量</i>
            <span class="busuanzi-value" id="busuanzi_value_page_pv"></span>
            </span>
                            <div class="post-wordcount">
                <span class="post-meta-item-icon">
                  <i class="fa fa-file-word-o"></i>
                </span>
                                <span class="post-meta-item-text">字数统计&#58;</span>
                                <span title="字数统计">
                  {{$article->words}}
                </span>
                                <span class="post-meta-divider">|</span>
                                <span class="post-meta-item-icon">
                  <i class="fa fa-clock-o"></i>
                </span>
                                <span class="post-meta-item-text">阅读时长 &asymp;</span>
                                <span title="阅读时长">
                  {{$article->read}}
                </span>

                            </div>
                        </div>
                    </header>
                    <div class="post-body" itemprop="articleBody">
                        {!! $article->content_html !!}
                    </div>
                    <div>
                        <div class="my_post_copyright">
                            <p><span>本文标题:</span><a href="{{ route('articles.show', $article->id) }}">客户端服务端消息推送模块设计</a>
                            </p>
                            <p><span>文章作者:</span><a href="{{route('home')}}" title="访问 Mrcoder 的个人博客">Mrcoder</a></p>
                            <p><span>发布时间:</span>{{$article->created_at_date}}</p>
                            <p><span>最后更新:</span>{{$article->updated_at_date}}</p>
                            <p><span>原始链接:</span>
                                <a href="{{ route('articles.show', $article->id) }}"
                                   title="客户端服务端消息推送模块设计">{{ route('articles.show', $article->id) }}</a>
                                <span class="copy-path" title="点击复制文章链接"><i class="fa fa-clipboard"
                                                                            data-clipboard-text="{{ route('articles.show', $article->id) }}"
                                                                            aria-label="复制成功！"></i></span>
                            </p>
                            <p><span>许可协议:</span><i class="fa fa-creative-commons"></i> <a rel="license"
                                                                                           href="#"
                                                                                           target="_blank"
                                                                                           title="Attribution-NonCommercial-NoDerivatives 4.0 International (CC BY-NC-ND 4.0)">署名-非商业性使用-禁止演绎
                                    4.0 国际</a> 转载请保留原文链接及作者。</p>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div style="text-align:center;color: #ccc;font-size:14px;">-------------本文结束<i
                                        class="fa fa-paw"></i>感谢您的阅读-------------
                            </div>
                        </div>
                    </div>
                    <footer class="post-footer">
                        <div class="post-tags">
                            @if($tags)
                                @foreach($tags as $tag)
                            <a href="{{route('tags')}}/{{$tag->id}}/" rel="tag"><i class="fa fa-tag"></i> {{$tag->name}}</a>
                                @endforeach
                            @endif
                        </div>
                        <div class="post-nav">
                        @if($preArticle)
                            <div class="post-nav-next post-nav-item">
                                <a href="{{ route('articles.show', $preArticle->id) }}" rel="next" title="{{$preArticle->title}}">
                                    <i class="fa fa-chevron-left"></i>{{$preArticle->title}}
                                </a>
                            </div>
                        @endif
                            <span class="post-nav-divider"></span>
                        @if($bacArticle)
                            <div class="post-nav-prev post-nav-item">
                                <a href="{{ route('articles.show', $bacArticle->id) }}" rel="prev" title="{{$bacArticle->title}}">
                                    {{$bacArticle->title}} <i class="fa fa-chevron-right"></i>
                                </a>
                            </div>
                        @endif
                        </div>
                    </footer>
                </div>
            </article>
            <div class="post-spread">
            </div>
        </div>
    </div>

    <div class="comments v" id="comments" style="opacity: 1; display: block;">
        <div class="vwrap">
            <div class="vheader item3"><input name="nick" id="nick" placeholder="昵称" class="vnick vinput"
                                              type="text" value="{{ $input->name or '' }}"><input
                        name="email" id="email" placeholder="邮箱" class="vmail vinput" type="email"
                        value="{{ $input->email or '' }}"><input name="link"
                                                                 id="link"
                                                                 placeholder="网址(http://)"
                                                                 class="vlink vinput"
                                                                 type="text" value="{{ $input->website or '' }}">
                <input type="hidden" id="parent_id" name="parent_id">
                <input type="hidden" id="target_id" name="target_id">
            </div>
            <div class="vedit"><textarea id="veditor" class="veditor vinput" placeholder="留言给博主"></textarea>
                <div class="vctrl">
                    {{--<span class="vemoji-btn">Emoji</span> | <span class="vpreview-btn">Preview</span>--}}
                </div>
                {{--<div class="vemojis" style="display:none;"><i name="grinning" title="grinning">😀</i><i name="smiley"--}}
                {{--title="smiley">😃</i><i--}}
                {{--name="smile" title="smile">😄</i><i name="grin" title="grin">😁</i><i name="laughing"--}}
                {{--title="laughing">😆</i><i--}}
                {{--name="sweat_smile" title="sweat_smile">😅</i><i name="joy" title="joy">😂</i><i name="blush"--}}
                {{--title="blush">😊</i><i--}}
                {{--name="innocent" title="innocent">😇</i><i name="wink" title="wink">😉</i><i name="relieved"--}}
                {{--title="relieved">😌</i><i--}}
                {{--name="heart_eyes" title="heart_eyes">😍</i><i name="kissing_heart"--}}
                {{--title="kissing_heart">😘</i><i name="kissing"--}}
                {{--title="kissing">😗</i><i--}}
                {{--name="kissing_smiling_eyes" title="kissing_smiling_eyes">😙</i><i name="kissing_closed_eyes"--}}
                {{--title="kissing_closed_eyes">😚</i><i--}}
                {{--name="yum" title="yum">😋</i><i name="stuck_out_tongue_winking_eye"--}}
                {{--title="stuck_out_tongue_winking_eye">😜</i><i--}}
                {{--name="stuck_out_tongue_closed_eyes" title="stuck_out_tongue_closed_eyes">😝</i><i--}}
                {{--name="stuck_out_tongue" title="stuck_out_tongue">😛</i><i name="sunglasses"--}}
                {{--title="sunglasses">😎</i><i--}}
                {{--name="smirk" title="smirk">😏</i><i name="unamused" title="unamused">😒</i><i--}}
                {{--name="disappointed" title="disappointed">😞</i><i name="pensive" title="pensive">😔</i><i--}}
                {{--name="worried" title="worried">😟</i><i name="confused" title="confused">😕</i><i--}}
                {{--name="persevere" title="persevere">😣</i><i name="confounded" title="confounded">😖</i><i--}}
                {{--name="tired_face" title="tired_face">😫</i><i name="weary" title="weary">😩</i><i--}}
                {{--name="angry" title="angry">😠</i><i name="rage" title="rage">😡</i><i name="no_mouth"--}}
                {{--title="no_mouth">😶</i><i--}}
                {{--name="neutral_face" title="neutral_face">😐</i><i name="expressionless"--}}
                {{--title="expressionless">😑</i><i--}}
                {{--name="hushed" title="hushed">😯</i><i name="frowning" title="frowning">😦</i><i--}}
                {{--name="anguished" title="anguished">😧</i><i name="open_mouth" title="open_mouth">😮</i><i--}}
                {{--name="astonished" title="astonished">😲</i><i name="dizzy_face" title="dizzy_face">😵</i><i--}}
                {{--name="flushed" title="flushed">😳</i><i name="scream" title="scream">😱</i><i name="fearful"--}}
                {{--title="fearful">😨</i><i--}}
                {{--name="cold_sweat" title="cold_sweat">😰</i><i name="cry" title="cry">😢</i><i--}}
                {{--name="disappointed_relieved" title="disappointed_relieved">😥</i><i name="sob" title="sob">😭</i><i--}}
                {{--name="sweat" title="sweat">😓</i><i name="sleepy" title="sleepy">😪</i><i name="sleeping"--}}
                {{--title="sleeping">😴</i><i--}}
                {{--name="mask" title="mask">😷</i><i name="smiling_imp" title="smiling_imp">😈</i><i--}}
                {{--name="smiley_cat" title="smiley_cat">😺</i><i name="smile_cat" title="smile_cat">😸</i><i--}}
                {{--name="joy_cat" title="joy_cat">😹</i><i name="heart_eyes_cat"--}}
                {{--title="heart_eyes_cat">😻</i><i name="smirk_cat"--}}
                {{--title="smirk_cat">😼</i><i--}}
                {{--name="kissing_cat" title="kissing_cat">😽</i><i name="scream_cat"--}}
                {{--title="scream_cat">🙀</i><i--}}
                {{--name="crying_cat_face" title="crying_cat_face">😿</i><i name="pouting_cat"--}}
                {{--title="pouting_cat">😾</i><i--}}
                {{--name="cat" title="cat">🐱</i><i name="mouse" title="mouse">🐭</i><i name="cow" title="cow">🐮</i><i--}}
                {{--name="monkey_face" title="monkey_face">🐵</i><i name="hand" title="hand">✋</i><i name="fist"--}}
                {{--title="fist">✊</i><i--}}
                {{--name="v" title="v">✌️</i><i name="point_up" title="point_up">👆</i><i name="point_down"--}}
                {{--title="point_down">👇</i><i--}}
                {{--name="point_left" title="point_left">👈</i><i name="point_right"--}}
                {{--title="point_right">👉</i><i name="facepunch"--}}
                {{--title="facepunch">👊</i><i--}}
                {{--name="wave" title="wave">👋</i><i name="clap" title="clap">👏</i><i name="open_hands"--}}
                {{--title="open_hands">👐</i><i--}}
                {{--name="+1" title="+1">👍</i><i name="-1" title="-1">👎</i><i name="ok_hand" title="ok_hand">👌</i><i--}}
                {{--name="pray" title="pray">🙏</i><i name="ear" title="ear">👂</i><i name="eyes" title="eyes">👀</i><i--}}
                {{--name="nose" title="nose">👃</i><i name="lips" title="lips">👄</i><i name="tongue"--}}
                {{--title="tongue">👅</i><i--}}
                {{--name="heart" title="heart">❤️</i><i name="cupid" title="cupid">💘</i><i--}}
                {{--name="sparkling_heart" title="sparkling_heart">💖</i><i name="star" title="star">⭐️</i><i--}}
                {{--name="sparkles" title="sparkles">✨</i><i name="zap" title="zap">⚡️</i><i name="sunny"--}}
                {{--title="sunny">☀️</i><i--}}
                {{--name="cloud" title="cloud">☁️</i><i name="snowflake" title="snowflake">❄️</i><i--}}
                {{--name="umbrella" title="umbrella">☔️</i><i name="coffee" title="coffee">☕️</i><i--}}
                {{--name="airplane" title="airplane">✈️</i><i name="anchor" title="anchor">⚓️</i><i name="watch"--}}
                {{--title="watch">⌚️</i><i--}}
                {{--name="phone" title="phone">☎️</i><i name="hourglass" title="hourglass">⌛️</i><i name="email"--}}
                {{--title="email">✉️</i><i--}}
                {{--name="scissors" title="scissors">✂️</i><i name="black_nib" title="black_nib">✒️</i><i--}}
                {{--name="pencil2" title="pencil2">✏️</i><i name="x" title="x">❌</i><i name="recycle"--}}
                {{--title="recycle">♻️</i><i--}}
                {{--name="white_check_mark" title="white_check_mark">✅</i><i name="negative_squared_cross_mark"--}}
                {{--title="negative_squared_cross_mark">❎</i><i--}}
                {{--name="m" title="m">Ⓜ️</i><i name="i" title="i">ℹ️</i><i name="tm" title="tm">™️</i><i--}}
                {{--name="copyright" title="copyright">©️</i><i name="registered" title="registered">®️</i>--}}
                {{--</div>--}}
                {{--<div class="vinput vpreview" style="display:none;"></div>--}}
            </div>
            <div class="vcontrol">
                <div class="col col-20" title="Markdown is supported">
                    {{--<a href="https://segmentfault.com/markdown"--}}
                    {{--target="_blank">--}}
                    {{--<svg class="markdown" viewBox="0 0 16 16" version="1.1" width="16" height="16"--}}
                    {{--aria-hidden="true">--}}
                    {{--<path fill-rule="evenodd"--}}
                    {{--d="M14.85 3H1.15C.52 3 0 3.52 0 4.15v7.69C0 12.48.52 13 1.15 13h13.69c.64 0 1.15-.52 1.15-1.15v-7.7C16 3.52 15.48 3 14.85 3zM9 11H7V8L5.5 9.92 4 8v3H2V5h2l1.5 2L7 5h2v6zm2.99.5L9.5 8H11V5h2v3h1.5l-2.51 3.5z"></path>--}}
                    {{--</svg>--}}
                    {{--</a>--}}
                </div>
                <div class="col col-80 text-right">
                    <button type="button" id="replayBtn" title="Cmd|Ctrl+Enter" class="vsubmit vbtn">回复</button>
                </div>
            </div>
            <div style="display:none;" class="vmark"></div>
        </div>
        <div class="vinfo" style="display:block;">
            <div class="vcount col"><span class="vnum">{{$count}}</span> 评论</div>
        </div>


        <div class="vlist">
            @foreach($comments as $comment)
                <div class="vcard" id="">
                    <img class="vimg" src="{{ $comment->master->avatar or '/images/default.png' }}">
                    <div class="vh" rootid="">
                        <div class="vhead">
                            <span class="vnick">{{$comment->name }}</span>
                            <span class="vsys">{{ $comment->city }}</span>
                            <span class="vsys">{{ $comment->browser }}</span>
                            <span class="vsys">{{ $comment->os }}</span>
                        </div>
                        <div class="vmeta">
                            <span class="vtime">3 小时前</span>
                            <span rid="" cid=""
                                  at="@" mail=""
                                  class="vat"
                                  onclick="reply({{ $comment->id }}, {{ $comment->id }}, '{{ $comment->name }}')">回复</span>
                        </div>
                        <div class="vcontent">
                            <p>{{ $comment->content }}</p>
                        </div>
                        @foreach($comment->replys as $reply)
                            <div class="vquote">
                                <div class="vcard" id="">
                                    <img class="vimg"
                                         src="{{ $reply->master->avatar or '/images/default.png' }}">
                                    <div class="vh" rootid="">
                                        <div class="vhead"><span class="vnick">{{$reply->name }}</span>
                                            <span class="vsys">{{ $reply->city }}</span>
                                            <span class="vsys">{{ $reply->browser }}</span>
                                            <span class="vsys">{{ $reply->os }}</span>
                                        </div>
                                        <div class="vmeta">
                                            <span class="vtime">2 小时前</span>
                                            <span rid="" cid=""
                                                  at="@" mail="" class="vat"
                                                  onclick="reply({{ $comment->id }}, {{ $reply->id }}, '{{ $reply->name }}')">回复</span>
                                        </div>
                                        <div class="vcontent">
                                            <a class="at">@ {{$reply->target_name}}</a>
                                            <p>{{$reply->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('sidebar')
    @parent
    <aside id="sidebar" class="sidebar">
        <div class="sidebar-inner">
            <ul class="sidebar-nav motion-element">
                <li class="sidebar-nav-toc sidebar-nav-active" data-target="post-toc-wrap">
                    文章目录
                </li>
                <li class="sidebar-nav-overview" data-target="site-overview-wrap">
                    站点概览
                </li>
            </ul>
            <section class="site-overview-wrap sidebar-panel">
                <div class="site-overview">
                    <div class="site-author motion-element" itemprop="author" itemscope=""
                         itemtype="">
                        <img class="site-author-image" itemprop="image" src="/next/images/avatar.jpg" alt="MrCoder技术栈头像">
                        <p class="site-author-name" itemprop="name">MrCoder</p>
                        <p class="site-description motion-element"
                           itemprop="description">{{setting('web_description', 'MrCoder技术栈')}}</p>
                    </div>
                    <nav class="site-state motion-element">
                        <div class="site-state-item site-state-posts">
                            <a href="{{route('home')}}">
                                <span class="site-state-item-count">{{$articleCount}}</span>
                                <span class="site-state-item-name">日志</span>
                            </a>
                        </div>
                        <div class="site-state-item site-state-categories">
                            <a href="{{route('cates')}}">
                                <span class="site-state-item-count">{{$catesCount}}</span>
                                <span class="site-state-item-name">分类</span>
                            </a>
                        </div>
                        <div class="site-state-item site-state-tags">
                            <a href="{{route('tags')}}">
                                <span class="site-state-item-count">{{$tagsCount}}</span>
                                <span class="site-state-item-name">标签</span>
                            </a>
                        </div>
                    </nav>
                    {{--<div class="feed-link motion-element">--}}
                    {{--<a href="/atom.xml" rel="alternate">--}}
                    {{--<i class="fa fa-rss"></i>--}}
                    {{--RSS--}}
                    {{--</a>--}}
                    {{--</div>--}}
                    <div class="links-of-author motion-element">
                  <span class="links-of-author-item">
                    <a href="https://frcoderblog.github.io" target="_blank" title="GitHub">
                        <i class="fa fa-fw fa-github"></i>GitHub</a>
                  </span>
                        <span class="links-of-author-item">
                    <a href="{{route('home')}}" target="_blank" title="Wrsee">
                        <i class="fa fa-fw fa-code"></i>Wrsee</a>
                  </span>
                        <span class="links-of-author-item">
                    <a href="http://frider.coding.me" target="_blank" title="Coding">
                        <i class="fa fa-fw fa-terminal"></i>Coding</a>
                  </span>
                    </div>
                </div>
            </section>
            <!--noindex-->
            <section class="post-toc-wrap motion-element sidebar-panel sidebar-panel-active">
                <div class="post-toc">
                    <div class="post-toc-content">
                        <ol class="nav">
                            @if($outline)
                                @foreach($outline as $k => $item)
                            <li class="nav-item nav-level-1">
                                <a class="nav-link" href="#{{$item['id']}}">
                                    <span class="nav-number">{{$k+1}}.</span> <span class="nav-text">{{$item['name']}}</span>
                                </a>
                            </li>
                                @endforeach
                            @endif
                            {{--<li class="nav-item nav-level-1"><a class="nav-link" href="#技术选型"><span class="nav-number">2.</span>--}}
                                    {{--<span class="nav-text">技术选型</span></a></li>--}}
                            {{--<li class="nav-item nav-level-1"><a class="nav-link" href="#实现案例"><span class="nav-number">3.</span>--}}
                                    {{--<span class="nav-text">实现案例</span></a>--}}
                                {{--<ol class="nav-child"><li class="nav-item nav-level-2"><a class="nav-link" href="#二级"><span class="nav-number">1.1.</span> <span class="nav-text">二级</span></a></li></ol>--}}

                            {{--</li>--}}

                        </ol>
                    </div>
                </div>
            </section>
            <!--/noindex-->
        </div>
    </aside>
@endsection
@push('importscripts')
    <script type="text/javascript" src="/next/js/src/scrollspy.js?v=5.1.4"></script>
    <script type="text/javascript" src="/next/js/src/post-details.js?v=5.1.4"></script>
    <script src="/next/js/src/Valine.min.js"></script>
    <script src="/next/js/src/layer/layer.js"></script>
    <script src="http://pv.sohu.com/cityjson?ie=utf-8"></script>
    <script src="/next/js/src/clipboard.min.js"></script>
    <script src="/next/js/src/sweetalert.min.js"></script>
@endpush
@section('diyscript')
    @parent
    <script>
        var clipboard = new ClipboardJS('.fa-clipboard');
        clipboard.on('success', $(function () {
            $(".fa-clipboard").click(function () {
                swal({
                    title: "",
                    text: '复制成功',
                    html: false,
                    timer: 500,
                    showConfirmButton: false
                });
            });
        }));
        clipboard.on('error', function (e) {
            console.log(e);
        });
    </script>

    <script type="text/javascript">
        function getOS() {
            var sUserAgent = navigator.userAgent;
            var isWin = (navigator.platform == "Win32") || (navigator.platform == "Windows");
            var isMac = (navigator.platform == "Mac68K") || (navigator.platform == "MacPPC") || (navigator.platform == "Macintosh") || (navigator.platform == "MacIntel");
            if (isMac) return "Mac";
            var isUnix = (navigator.platform == "X11") && !isWin && !isMac;
            if (isUnix) return "Unix";
            var isLinux = (String(navigator.platform).indexOf("Linux") > -1);
            if (isLinux) return "Linux";
            if (isWin) {
                var isWin2K = sUserAgent.indexOf("Windows NT 5.0") > -1 || sUserAgent.indexOf("Windows 2000") > -1;
                if (isWin2K) return "Win2000";
                var isWinXP = sUserAgent.indexOf("Windows NT 5.1") > -1 || sUserAgent.indexOf("Windows XP") > -1;
                if (isWinXP) return "WinXP";
                var isWin2003 = sUserAgent.indexOf("Windows NT 5.2") > -1 || sUserAgent.indexOf("Windows 2003") > -1;
                if (isWin2003) return "Win2003";
                var isWinVista = sUserAgent.indexOf("Windows NT 6.0") > -1 || sUserAgent.indexOf("Windows Vista") > -1;
                if (isWinVista) return "WinVista";
                var isWin7 = sUserAgent.indexOf("Windows NT 6.1") > -1 || sUserAgent.indexOf("Windows 7") > -1;
                if (isWin7) return "Win7";
                var isWin10 = sUserAgent.indexOf("Windows NT 10") > -1 || sUserAgent.indexOf("Windows 10") > -1;
                if (isWin10) return "Win10";
            }
            return "NBOS";
        }

        function getBrowserInfo() {
            var agent = navigator.userAgent.toLowerCase();
            var regStr_ie = /msie [\d.]+;/gi;
            var regStr_ff = /firefox\/[\d.]+/gi
            var regStr_chrome = /chrome\/[\d.]+/gi;
            var regStr_saf = /safari\/[\d.]+/gi;
            //IE
            if (agent.indexOf("msie") > 0) {
                return agent.match(regStr_ie)[0];
            }
            //firefox
            if (agent.indexOf("firefox") > 0) {
                return agent.match(regStr_ff)[0];
            }
            //Safari
            if (agent.indexOf("safari") > 0 && agent.indexOf("chrome") < 0) {
                return agent.match(regStr_saf)[0];
            }
            //Chrome
            if (agent.indexOf("chrome") > 0) {
                return agent.match(regStr_chrome)[0];
            }
            return "NB浏览器";
        }

        function reply(parent_id, target_id, target_name) {
            $('#parent_id').val(parent_id);
            $('#target_id').val(target_id);
            $('#veditor').attr('placeholder', ' 回复 @' + target_name + '：');
        }

        $(function () {
            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
            });
            $('#replayBtn').bind("click", function () {
                var options = {
                    url: "/comments",
                    type: 'post',
                    data: {
                        "article_id": "{{$article->id}}",
                        "content": $('#veditor').val(),
                        "name": $('#nick').val(),
                        "email": $('#email').val(),
                        "website": $('#link').val(),
                        "parent_id": $('#parent_id').val(),
                        "target_id": $('#target_id').val(),
                        "browser": getBrowserInfo(),
                        "os": getOS(),
                        'real_ip': returnCitySN['cip'],
                        "city": returnCitySN['cname'],
                    },
                    success: function (data) {
                        layer.alert(data.msg, function () {
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.closeAll(index);
                            location.reload()
                        });
                    },
                    error: function (XMLHttpRequest, msg, e) {
                        layer.alert("服务器错误,请稍后再试");
                    }
                };
                $.ajax(options);
                return false;
            });
        });
    </script>
@endsection

