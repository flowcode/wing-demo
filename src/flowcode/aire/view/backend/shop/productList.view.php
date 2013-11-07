<script type="text/javascript">
    function actualizarPagina(valor) {
        $("#pagina-sel").val(valor);
        actualizarLista();
    }
    function actualizarLista() {
        var paginaSel = $("#pagina-sel").val();
        var searchSel = $("#search").val();

        var url = "/adminProduct/index";
        if (paginaSel) {
            url += "/page/" + paginaSel.toLowerCase();
        }
        if (searchSel) {
            url += "/search/" + encodeURI(searchSel);
        }
        window.location = url;
    }
    $(document).ready(function() {
        /* search form */
        $("#search").focus(function() {
            $(this).keyup(function(e) {
                if (e.keyCode === 13) {
                    actualizarLista();
                }
            });
        });
        $("#search").focus()
        
    });
</script>
<div class="page-header">
    <h1>Productos
        <a class="btn btn-default" href="/adminProduct/create" ><i class="icon-plus icon-white"></i> Nuevo</a>
    </h1>
</div>

<form action="/adminProduct/index" method="post" class="form-inline">
    <div class="form-group">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="form-control" value="<?php echo $viewData['filter'] ?>"/>
    </div>
    <button type="submit"class="btn btn-default"><li class="glyphicon glyphicon-search"></li> Buscar</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>            
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewData["pager"]->getItems() as $entity): ?>
            <tr>
                <td><?php echo $entity->getId() ?></td>
                <td><?php echo $entity->getName() ?></td>
                <td><?php echo $entity->getDescription() ?></td>
                <td><?php echo $entity->getStatus() ?></td>            
                <td style="width: 100px;">
                    <a href="/adminProduct/edit/<? echo $entity->getId() ?>" class="btn btn-default btn-sm" ><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="/adminProduct/delete/<? echo $entity->getId() ?>" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="pull-right">
    Total de <?php echo $viewData["pager"]->getItemCount() ?> products.
</p>

<input type="hidden" id="pagina-sel" value="" />
<ul class="pager">
    <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData['pager']->getPrevPage() ?>)"><i class="glyphicon glyphicon-chevron-left "></i></a></li>
    <span>pagina</span>
    <strong><?php echo $viewData['page'] ?></strong>
    <span>de <?php echo $viewData['pager']->getPageCount() ?></span>
    <li><a class="next" onclick="actualizarPagina(<?php echo $viewData['pager']->getNextPage() ?>)"><i class="glyphicon glyphicon-chevron-right "></i></a></li>
</ul>