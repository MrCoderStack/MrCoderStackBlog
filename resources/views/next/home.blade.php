@extends('next.layouts.app')
@section('content')
    @parent
    <div id="content" class="content">
        <section id="posts" class="posts-expand">
            @foreach($articles as $article)
                <article class="post post-type-normal" itemscope="" itemtype="">
                    <div class="post-block">
                        <link itemprop="mainEntityOfPage"
                              href="{{ route('articles.show', $article->id) }}">
                        <span hidden itemprop="author" itemscope="" itemtype="">
                      <meta itemprop="name" content="{{setting('web_name', 'Mrcoder')}}">
                      <meta itemprop="description" content="@yield('title', setting('web_name', 'Mrcoder'))">
                      <meta itemprop="image" content="next/images/avatar.jpg"></span>
                        <span hidden itemprop="publisher" itemscope=""
                              itemtype="">
                      <meta itemprop="name" content="@yield('title', setting('web_name', 'Mrcoder'))"></span>
                        <header class="post-header">
                            <h1 class="post-title" itemprop="name headline">
                                <a class="post-title-link" href="{{ route('articles.show', $article->id) }}"
                                   itemprop="url">{{ $article->title }}</a>
                            </h1>
                            <div class="post-meta">
                        <span class="post-time">
                          <span class="post-meta-item-icon">
                            <i class="fa fa-calendar-o"></i>
                          </span>
                          <span class="post-meta-item-text">发表于</span>
                          <time title="创建于" itemprop="dateCreated datePublished"
                                datetime="{{$article->created_at_date}}">{{$article->created_at_date}}</time></span>
                                <span class="post-category">
                          <span class="post-meta-divider">|</span>
                          <span class="post-meta-item-icon">
                            <i class="fa fa-folder-o"></i>
                          </span>
                          <span class="post-meta-item-text">分类于</span>
                          <span itemprop="about" itemscope="" itemtype="">
                            <a href="/cates/{{$article->cate_id}}/" itemprop="url" rel="index">
                              <span itemprop="name">{{$article->cates}}</span></a>
                          </span>
                        </span>
                                <span class="post-comments-count">
                          <span class="post-meta-divider">|</span>
                          <span class="post-meta-item-icon">
                            <i class="fa fa-comment-o">{{$article->comments}}</i>
                          </span>
                          <a href="{{ route('articles.show', $article->id) }}/#comments" itemprop="discussionUrl">
                            <span class="post-comments-count valine-comment-count"
                                  data-xid="{{ route('articles.show', $article->id) }}"
                                  itemprop="commentCount"></span>
                          </a>
                        </span>
                                <div class="post-wordcount">
                          <span class="post-meta-item-icon">
                            <i class="fa fa-file-word-o"></i>
                          </span>
                                    <span class="post-meta-item-text">字数统计&#58;</span>
                                    <span title="字数统计">{{$article->words}}</span>
                                    <span class="post-meta-divider">|</span>
                                    <span class="post-meta-item-icon">
                            <i class="fa fa-clock-o"></i>
                          </span>
                                    <span class="post-meta-item-text">阅读时长 &asymp;</span>
                                    <span title="阅读时长">{{$article->read}}</span></div>
                            </div>
                        </header>
                        <div class="post-body" itemprop="articleBody">
                        {{ $article->content }}
                        <!--noindex-->
                            <div class="post-button text-center">
                                <a class="btn" href="{{ route('articles.show', $article->id) }}"
                                   rel="contents">阅读全文
                                    &raquo;</a></div>
                            <!--/noindex--></div>
                        <div></div>
                        <div></div>
                        <footer class="post-footer">
                            <div class="post-eof"></div>
                        </footer>
                    </div>
                </article>
            @endforeach
        </section>

        {{$articles->links()}}
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
                           itemprop="description">@yield('title', setting('web_name', 'Laravel'))</p>
                    </div>
                    <nav class="site-state motion-element">
                        <div class="site-state-item site-state-posts">
                            <a href="/">
                                <span class="site-state-item-count">{{$articleCount}}</span>
                                <span class="site-state-item-name">日志</span></a>
                        </div>
                        <div class="site-state-item site-state-categories">
                            <a href="/cates">
                                <span class="site-state-item-count">{{$catesCount}}</span>
                                <span class="site-state-item-name">分类</span></a>
                        </div>
                        <div class="site-state-item site-state-tags">
                            <a href="/tags">
                                <span class="site-state-item-count">{{$tagsCount}}</span>
                                <span class="site-state-item-name">标签</span></a>
                        </div>
                    </nav>
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
@endpush

@section('diyscript')
    @parent
@endsection