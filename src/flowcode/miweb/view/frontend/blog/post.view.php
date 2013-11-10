<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=401882719882002";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<div class="content">
    <ul class="breadcrumb">
        <li><a href="/">Inicio</a></li>
        <li>&GT;</li>
        <li><a href="/blog">Blog</a></li>
        <li>&GT;</li>
        <li class="active"><?php echo ucfirst($viewData['post']->getTitle()); ?></li>
    </ul>
</div>
<div class="page-header blog">
    <span>NUESTRO BLOG</span>
</div>
<div class="blog">

    <div id="destacado" class="content" style="height: 1px;">
        <div class="descripcionImagen" style="height: 0px;">
            <div class="descripcionTexto">

            </div>
            <div class="tags" style="top: 30px;">
                <h2>Tags</h2>
                <ul>
                    <?php foreach ($viewData['tags'] as $tag): ?>
                        <li><a href="/blog/index/tag/<?= urlencode($tag->getName()) ?>"><?php echo $tag ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>		
        </div>
        <div class="box-right" style="height: 0px;">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-2">
                </div>
            </div>
            <div class="row bottom">
            </div>
        </div>
    </div>
    <div>
        <div class="content">
            <div class="body post">

                <h1><?php echo $viewData['post']->getTitle(); ?></h1>
                <span class="post-date"><?php echo $viewData['post']->getDate(); ?></span> 
                <? if ($viewData['post']->getType() == "d"): ?>
                    <div class="post-intro"><?php echo $viewData['post']->getIntro(); ?></div>
                <? endif; ?>
                <div class="post-body"><?php echo $viewData['post']->getBody(); ?></div>

            </div>
        </div>
        <div class="footer">
            <div class="content">
                <div class="body">
                    <a href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(location.href),
                'facebook-share-dialog', 'width=626,height=436');
        return false;">
                        <img src="/images/blog_icon_fb.png"/>
                    </a>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=http://localhost/miweb-website&amp;title=<?php echo $viewData['post']->getTitle(); ?>&amp;summary=Put your summary here" target="_blank">
                        <img src="/images/blog_icon_linkedin.png"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="body">
                <div class="fb-comments" data-href="http://example.com/comments" data-numposts="10" data-width="700"></div>
            </div>
        </div>
    </div>
</div>