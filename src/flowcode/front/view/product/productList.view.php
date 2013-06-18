<style>
    .product-list{
        display: table;
    }
    .product{
        margin: 10px;
        width: 200px;
        height: 200px;
    }
</style>
<div class="numpage-header">
    <h1>Products</h1>
</div>

<div class="form-search">
    <div class="input-append">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="span8 search-query" value="<?php echo $viewData["filter"] ?>">
        <button type="button" class="btn" onclick="actualizarLista()" ><i class="icon-search icon-white"></i> Buscar</button>
    </div>
</div>

<div class="product-list">
    <?php foreach ($viewData["pager"]->getItems() as $entity): ?>
        <div class="product pull-left well">
            <h4><a href="/product/view/<? echo $entity->getId() ?>"><?php echo $entity->getName() ?></a></h4>
            <div><?php echo $entity->getDescription() ?></div>
            <img src="<? echo $entity->getImages()->current()->getPath() ?>" width="150" height="150">
        </div>
    <?php endforeach; ?>
</div>

<p class="pull-right">
    Total de <?php echo $viewData["pager"]->getItemCount() ?> products.
</p>
<input type="hidden" id="pagina-sel" value="" />
<ul class="pager">
    <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData["pager"]->getPrevPage() ?>)"><i class="icon-chevron-left icon-white"></i></a></li>
    <span>pagina</span>
    <strong><?php echo $viewData["numpage"] ?></strong>
    <span>de <?php echo $viewData["pager"]->getPageCount() ?></span>
    <li><a class="next" onclick="actualizarPagina(<?php echo $viewData["pager"]->getNextPage() ?>)"><i class="icon-chevron-right icon-white"></i></a></li>
</ul>

