<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="generator" content="Laravel">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#next">
    <meta http-equiv="Cache-Control" content="no-transform">
    <meta http-equiv="Cache-Control" content="no-siteapp">
    <link rel="apple-touch-icon" sizes="180x180" href="/next/images/apple-touch-icon-next.png?v=5.1.4">
    <link rel="icon" type="image/png" sizes="32x32" href="/next/images/favicon-32x32-next.png?v=5.1.4">
    <link rel="canonical" href="{{route('home')}}">
    <meta name="keywords" content="@yield('keywords', setting('web_name', 'Mrcoder'))">
    <meta name="description" content="@yield('description', setting('web_name', 'Mrcoder'))">
    <meta property="og:type" content="blog">
    <meta property="og:title" content="@yield('title', setting('web_name', 'Mrcoder'))">
    <meta property="og:url" content="{{route('home')}}">
    <meta property="og:site_name" content="@yield('title', setting('web_name', 'Mrcoder'))">
    <meta property="og:description" content="@yield('description', setting('web_name', 'Mrcoder'))">
    <meta property="og:locale" content="zh-Hans">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', setting('web_name', 'Mrcoder'))">
    <meta name="twitter:description" content="@yield('title', setting('web_name', 'Mrcoder'))">
    <title>@yield('title', setting('web_name', 'Mrcoder'))</title></head>
<body itemscope="" itemtype="" lang="zh-Hans">
<div class="container sidebar-position-left
    page-home">
    <div class="headband"></div>
    <header id="header" class="header" itemscope="" itemtype="">
        <div class="header-inner">
            <div class="site-brand-wrapper">
                <div class="site-meta ">
                    <div class="custom-logo-site-title">
                        <a href="{{route('home')}}" class="brand" rel="start">
                  <span class="logo-line-before">
                    <i>
                    </i>
                  </span>
                            <span class="site-title">{{setting('web_name', 'Mrcoder')}}</span>
                            <span class="logo-line-after">
                    <i>
                    </i>
                  </span>
                        </a>
                    </div>
                    <p class="site-subtitle">{{setting('web_name', 'Mrcoder')}}</p></div>
                <div class="site-nav-toggle">
                    <button>
                        <span class="btn-bar"></span>
                        <span class="btn-bar"></span>
                        <span class="btn-bar"></span>
                    </button>
                </div>
            </div>
            <nav class="site-nav">
                <ul id="menu" class="menu">
                    <li class="menu-item menu-item-home">
                        <a href="{{route('home')}}" rel="section">
                            <i class="menu-item-icon fa fa-fw fa-home"></i>
                            <br>首页</a></li>
                    <li class="menu-item menu-item-tags">
                        <a href="{{route('tags')}}" rel="section">
                            <i class="menu-item-icon fa fa-fw fa-tags"></i>
                            <br>标签</a></li>
                    <li class="menu-item menu-item-cates">
                        <a href="{{route('cates')}}" rel="section">
                            <i class="menu-item-icon fa fa-fw fa-th"></i>
                            <br>分类</a></li>
                    {{--<li class="menu-item menu-item-archives">--}}
                    {{--<a href="/archives/" rel="section">--}}
                    {{--<i class="menu-item-icon fa fa-fw fa-archive"></i>--}}
                    {{--<br>归档</a></li>--}}
                    <li class="menu-item menu-item-search">
                        <a href="javascript:;" class="popup-trigger">
                            <i class="menu-item-icon fa fa-search fa-fw"></i>
                            <br>搜索</a></li>
                </ul>
                <div class="site-search">
                    <div class="popup search-popup local-search-popup">
                        <div class="local-search-header clearfix">
                  <span class="search-icon">
                    <i class="fa fa-search"></i>
                  </span>
                            <span class="popup-btn-close">
                    <i class="fa fa-times-circle"></i>
                  </span>
                            <div class="local-search-input-wrapper">
                                <input autocomplete="off" placeholder="搜索..." spellcheck="false" type="text"
                                       id="local-search-input"></div>
                        </div>
                        <div id="local-search-result"></div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main id="main" class="main">
        <div class="main-inner">
            <div class="content-wrap">

                @yield('content')

                <div class="sidebar-toggle">
                    <div class="sidebar-toggle-line-wrap">
                        <span class="sidebar-toggle-line sidebar-toggle-line-first"></span>
                        <span class="sidebar-toggle-line sidebar-toggle-line-middle"></span>
                        <span class="sidebar-toggle-line sidebar-toggle-line-last"></span>
                    </div>
                </div>
                @yield('sidebar')
            </div>
    </main>
    <footer id="footer" class="footer">
        <div class="footer-inner">
            <div class="copyright">&copy;
                <span itemprop="copyrightYear">2018</span>
                <span class="with-love">
              <i class="fa fa-user"></i>
            </span>
                <span class="post-meta-item-text">编码先生</span>
                <span class="post-meta-divider">|</span>
                <span title="ICP主体备案号">粤ICP备19005341号-1</span>
            </div>
            <div class="busuanzi-count">
                <span class="site-uv">
              <i class="fa fa-user">总访客</i>
              <span class="busuanzi-value" id="busuanzi_value_site_uv"></span>
            </span>
                <span class="site-pv">
              <i class="fa fa-eye">访问量</i>
              <span class="busuanzi-value" id="busuanzi_value_site_pv"></span>
            </span>
            </div>
        </div>
    </footer>
    <div class="back-to-top">
        <i class="fa fa-arrow-up"></i>
    </div>
</div>
</body>
<script type="text/javascript" id="hexo.configurations">var NexT = window.NexT || {};
    var CONFIG = {
        root: '/',
        scheme: 'Mist',
        version: '5.1.4',
        sidebar: {
            "position": "left",
            "display": "post",
            "offset": 12,
            "b2t": false,
            "scrollpercent": false,
            "onmobile": false
        },
        fancybox: true,
        tabs: true,
        motion: {
            "enable": true,
            "async": false,
            "transition": {
                "post_block": "fadeIn",
                "post_header": "slideDownIn",
                "post_body": "slideDownIn",
                "coll_header": "slideLeftIn",
                "sidebar": "slideUpIn"
            }
        },
        duoshuo: {
            userId: '0',
            author: '博主'
        },
        algolia: {
            applicationID: '',
            apiKey: '',
            indexName: '',
            hits: {
                "per_page": 10
            },
            labels: {
                "input_placeholder": "Search for Posts",
                "hits_empty": "We didn't find any results for the search: ${query}",
                "hits_stats": "${hits} results found in ${time} ms"
            }
        }
    };</script>
<script type="text/javascript">
    if (Object.prototype.toString.call(window.Promise) !== '[object Function]') {
        window.Promise = null;
    }
</script>

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
<script>
    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        }
        else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>

<script type="text/javascript">
    //关闭搜索框
    var onPopupClose = function (e) {
        $('.popup').hide();
        $('#local-search-input').val('');
        $('.search-result-list').remove();
        $('#no-result').remove();
        $(".local-search-pop-overlay").remove();
        $('body').css('overflow', '');
    }

    //弹出搜索框
    function proceedsearch() {
        $("body")
            .append('<div class="search-popup-overlay local-search-pop-overlay"></div>')
            .css('overflow', 'hidden');
        $('.search-popup-overlay').click(onPopupClose);
        $('.popup').toggle();
        var $localSearchInput = $('#local-search-input');
        $localSearchInput.attr("autocapitalize", "none");
        $localSearchInput.attr("autocorrect", "off");
        $localSearchInput.focus();
    }

    $("#local-search-result").html("<div id='no-result'><i class='fa fa-search fa-5x' /></div>");

    //绑定搜索事件
    $("#local-search-input").bind('input propertychange', function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
        });
        $.ajax({
            url: "{{route('search')}}",
            dataType: "json",
            type: "POST",
            async: true,
            data: {"key": $('#local-search-input').val()},
            success: function (res) {
                if (res.code == '200') {
                    if (res.data.length != 0) {
                        resultItems = res.data;
                        var searchResultList = '<ul class=\"search-result-list\">';
                        resultItems.forEach(function (item) {
                            searchResultList += "<li><a href='/articles/" + item.id + "' class='search-result-title'>" + highlightKeyword(item.title, $('#local-search-input').val()) + "</a>" + "     分类于" + highlightKeyword(item.name, $('#local-search-input').val());
                            searchResultList += "<a href='/articles/" + item.id + "'><p class='search-result'>" + highlightKeyword(item.content_html, $('#local-search-input').val()) + "</p></a>";
                        })
                        searchResultList += "</ul>";
                        $("#local-search-result").html(searchResultList);
                    } else {
                        $("#local-search-result").html("<div id='no-result'><i class='fa fa-frown-o fa-5x' /></div>");
                    }
                } else {
                    alert("异常");
                }
            }
        });
    });

    //标红关键字
    function highlightKeyword(text, key) {
        reg = new RegExp(key, "g");
        var newStr = text.toString().replace(reg, "<b class='search-keyword'>" + key + "</b>"); //第一个参数是正则表达式。
        return newStr;
    }

    $('.popup-trigger').click(function (e) {
        e.stopPropagation();
        proceedsearch();
    });

    $('.popup-btn-close').click(onPopupClose);
    $('.popup').click(function (e) {
        e.stopPropagation();
    });
</script>

@stack('importscripts')
@yield('diyscript')

</html>



