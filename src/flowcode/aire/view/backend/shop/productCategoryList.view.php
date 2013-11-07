<script type="text/javascript">
    function actualizarPagina(valor) {
        $("#pagina-sel").val(valor);
        actualizarLista();
    }
    function actualizarLista() {
        var paginaSel = $("#pagina-sel").val();
        var searchSel = $("#search").val();

        var url = "#!adminProductCategory/index";
        if (paginaSel) {
            url += "/page/" + paginaSel.toLowerCase();
        }
        if (searchSel) {
            url += "/search/" + encodeURI(searchSel);
        }
        window.location = url;
    }
    $(document).ready(function() {
        $("#search").focus()
    });
</script>
<div class="page-header">
    <h1>Categorias de Productos
        <a class="btn btn-default" href="/adminProductCategory/create"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
    </h1>
</div>

<form action="/adminProductCategory/index" method="post" class="form-inline">
    <div class="form-group">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="form-control" value="<?php echo $viewData['filter'] ?>"/>
    </div>
    <button type="submit"class="btn btn-default"><li class="glyphicon glyphicon-search"></li> Buscar</button>
</form>

<table class="table table-condensed table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>            
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewData["pager"]->getItems() as $entity): ?>
            <tr>
                <td><?php echo $entity->getId() ?></td>
                <td><?php echo $entity->getName() ?></td>
                <td><?php echo $entity->getDescription() ?></td>            
                <td style="width: 100px;">
                    <a href="/adminProductCategory/edit/<? echo $entity->getId() ?>" class="btn btn-xs btn-default" ><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="/adminProductCategory/remove/<? echo $entity->getId() ?>" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="pull-right">
    Total de <?php echo $viewData["pager"]->getItemCount() ?> productCategorys.
</p>

<input type="hidden" id="pagina-sel" value="" />
<ul class="pager">
    <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData['pager']->getPrevPage() ?>)"><i class="glyphicon glyphicon-chevron-left "></i></a></li>
    <span>pagina</span>
    <strong><?php echo $viewData['page'] ?></strong>
    <span>de <?php echo $viewData['pager']->getPageCount() ?></span>
    <li><a class="next" onclick="actualizarPagina(<?php echo $viewData['pager']->getNextPage() ?>)"><i class="glyphicon glyphicon-chevron-right "></i></a></li>
</ul>