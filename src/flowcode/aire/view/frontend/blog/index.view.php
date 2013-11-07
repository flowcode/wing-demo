<div class="content">
    <ul class="breadcrumb">
        <li><a href="/">Inicio</a></li>
        <li>&GT;</li>
        <li class="active">Blog</li>
    </ul>
</div>
<div class="page-header blog">
    <span>NUESTRO BLOG</span>
</div>


<div class="blog">

    <div id="destacado" class="content">
        <div class="descripcionImagen">
            <div class="descripcionTexto">
                <p>Ya no basta con</p>
                <p>ser el mejor,</p>
                <p>hay que ser diferente.</p>
            </div>
            <div class="tags">
                <h2>Tags</h2>
                <ul>
                    <?php foreach ($viewData['tags'] as $tag): ?>
                        <li><a href="/blog/index/tag/<?= urlencode($tag->getName()) ?>"><?php echo $tag ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>		
        </div>
        <div class="box-right">
            <div class="row">
                <div class="col-2">
                    <p>Los ejecutivos hoy necesitan sus mentes abiertas para generar innovación en sus empresas a través de sus acciones creativas:</p>
                </div>
                <div class="col-2">
                    <p>Los ejecutivos hoy necesitan sus mentes abiertas para generar innovación en sus empresas a través de sus acciones creativas:</p>
                </div>
            </div>
            <div class="row bottom">
                <img src="/images/amarillo_chicos.png" />
                <div style="display: inline-block; width: 73%; margin-left: 25px;">
                    <p>Los escenarios de capacitación son puentes, experiencias compartidas, abiertas, colaborativas y holísticas tanto para nosotros como para los participantes</p>
                </div>
            </div>
        </div>
    </div>
    <div class="middlerow"></div>



    <div class="">
        <?php foreach ($viewData['pager']->getItems() as $entidad): ?>
            <div class="post">
                <div class="content">
                    <div class="body">
                        <a class="post-title" href="/blog/post/<?php echo $entidad->getPermalink() ?>" ><?php echo $entidad->getTitle() ?></a>
                        <span class="post-date"><?php echo $entidad->getFormatedDate() ?></span>
                        <? if ($entidad->getType() == 'd'): ?>
                            <div style="display: table;"><?php echo $entidad->getIntro(); ?></div>
                        <? else: ?>
                            <div style="display: table;"><?php echo $entidad->getBody(); ?></div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="footer">
                    <div class="content">
                        <div class="body">
                            <img src="/images/blog_icon_fb.png"/>
                            <img src="/images/blog_icon_linkedin.png"/>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <div class="content">
            <div class="pager body">
                <? if ($viewData['pager']->getPrevPage() != $viewData['pager']->getActualPage()): ?>
                    <a href="/blog/index/page/<?php echo $viewData['pager']->getPrevPage() ?>" >mas recientes</a>
                    <span> | </span>
                <? endif; ?>
                    <a href="/blog/index/page/<?php echo $viewData['pager']->getNextPage() ?>" >mas antiguos &rightarrow;</a>
            </div>
        </div>
    </div>



</div>