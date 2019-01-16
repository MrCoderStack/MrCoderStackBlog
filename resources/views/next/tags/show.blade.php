@extends('next.layouts.app')
@section('title'){{setting('web_name', 'MrCoder技术栈').'|'.$tagName}}@endsection
@section('keywords'){{setting('web_name', 'MrCoder技术栈').','.$tagName}}@endsection
@section('description'){{setting('web_name', 'MrCoder技术栈').','.$tagName}}@endsection
@section('content')
    @parent
    <div id="content" class="content">


        <div class="post-block category">

            <div id="posts" class="posts-collapse">
                <div class="collection-title">
                    <h1>{{$tagName}}
                        <small>标签</small>
                    </h1>
                </div>


                @if($articles)
                    @foreach($articles as $article)
                        <article class="post post-type-normal" itemscope="" itemtype="">
                            <header class="post-header">

                                <h2 class="post-title" style="margin-left: 100px;">

                                    <a class="post-title-link" href="{{route('articles.show', $article->id)}}"
                                       itemprop="url">

                                        <span itemprop="name">{{$article->title}}</span>

                                    </a>

                                </h2>

                                <div class="post-meta">
                                    <time class="post-time" itemprop="dateCreated"
                                          datetime="{{$article->created_at_date}}"
                                          content="{{$article->created_at_date}}">
                                        {{$article->created_at_date}}
                                    </time>
                                </div>

                            </header>
                        </article>
                    @endforeach
                @endif


            </div>

        </div>


        {{ $articles->links() }}


    </div>







@endsection
@section('sidebar')
    @parent
    <aside id="sidebar" class="sidebar">
        <div class="sidebar-inner">
            <section class="site-overview-wrap sidebar-panel sidebar-panel-active">
                <div class="site-overview">
                    <div class="site-author motion-element" itemprop="author" itemscope=""
                         itemtype="">
                        <img class="site-author-image" itemprop="image" src="/next/images/avatar.jpg"
                             alt="MrCoder">
                        <p class="site-author-name" itemprop="name">MrCoder</p>
                        <p class="site-description motion-element"
                           itemprop="description">setting('web_name', 'MrCoder技术栈')</p>
                    </div>
                    <nav class="site-state motion-element">
                        <div class="site-state-item site-state-posts">
                            <a href="{{route('home')}}">
                                <span class="site-state-item-count">{{$articleCount}}</span>
                                <span class="site-state-item-name">日志</span></a>
                        </div>
                        <div class="site-state-item site-state-categories">
                            <a href="{{route('cates')}}">
                                <span class="site-state-item-count">{{$catesCount}}</span>
                                <span class="site-state-item-name">分类</span></a>
                        </div>
                        <div class="site-state-item site-state-tags">
                            <a href="{{route('tags')}}">
                                <span class="site-state-item-count">{{$tagsCount}}</span>
                                <span class="site-state-item-name">标签</span></a>
                        </div>
                    </nav>
                    {{--<div class="feed-link motion-element">--}}
                    {{--<a href="/atom.xml" rel="alternate">--}}
                    {{--<i class="fa fa-rss"></i>RSS</a>--}}
                    {{--</div>--}}
                    <div class="links-of-author motion-element">
                    <span class="links-of-author-item">
                      <a href="https://frcoderblog.github.io" target="_blank" title="GitHub">
                        <i class="fa fa-fw fa-github"></i>GitHub</a>
                    </span>
                        <span class="links-of-author-item">
                      <a href="http://www.wrsee.com" target="_blank" title="Wrsee">
                        <i class="fa fa-fw fa-code"></i>Wrsee</a>
                    </span>
                        <span class="links-of-author-item">
                      <a href="http://frider.coding.me" target="_blank" title="Coding">
                        <i class="fa fa-fw fa-terminal"></i>Coding</a>
                    </span>
                    </div>
                </div>
            </section>
        </div>
    </aside>
@endsection

@push('importscripts')
    <link href="/next/lib/fancybox/source/jquery.fancybox.css?v=2.1.5" rel="stylesheet" type="text/css">
    <link href="/next/lib/font-awesome/css/font-awesome.min.css?v=4.6.2" rel="stylesheet" type="text/css">
    <link href="/next/css/main.css?v=5.1.4" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/next/css/sweetalert.mini.css">


    <script async src="/next/js/src/busuanzi.pure.mini.js"></script>
    <script type="text/javascript" src="/next/lib/jquery/index.js?v=2.1.3"></script>
    <script type="text/javascript" src="/next/lib/fastclick/lib/fastclick.min.js?v=1.0.6"></script>
    <script type="text/javascript" src="/next/lib/jquery_lazyload/jquery.lazyload.js?v=1.9.7"></script>
    <script type="text/javascript" src="/next/lib/velocity/velocity.min.js?v=1.2.1"></script>
    <script type="text/javascript" src="/next/lib/velocity/velocity.ui.min.js?v=1.2.1"></script>
    <script type="text/javascript" src="/next/lib/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
    <script type="text/javascript" src="/next/js/src/utils.js?v=5.1.4"></script>
    <script type="text/javascript" src="/next/js/src/motion.js?v=5.1.4"></script>
    <script type="text/javascript" src="/next/js/src/bootstrap.js?v=5.1.4"></script>
@endpush

@section('diyscript')
    @parent

@endsection