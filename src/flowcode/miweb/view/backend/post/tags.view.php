<script type="text/javascript">
    function actualizarPagina(valor) {
        $('#pagina-sel').val(valor);
        actualizarLista();
    }
    function actualizarLista() {
        var paginaSel = $('#pagina-sel').val();
        var searchSel = $('#search').val();

        var url = "/adminBlog/tags";
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

<ol class="breadcrumb">
    <li><a href="/admin">Inicio</a></li>
    <li class="active">Tags</li>
</ol>

<div class="page-header">
    <h1>Tags
        <a class="btn btn-default create" href="/adminBlog/createTag"><i class="glyphicon glyphicon-plus"></i> Nuevo</a>
    </h1>
</div>

<form action="#!adminBlog/index" method="post" class="form-inline">
    <div class="form-group">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="form-control" value="<?php echo $viewData['filter'] ?>">
    </div>
    <button type="button" class="btn btn-default" onclick="actualizarLista()" ><i class="glyphicon glyphicon-search"></i> Buscar</button>
</form>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($viewData['pager']->getItems() as $entity): ?>
        <tr>
            <td><?php echo $entity->getId() ?></td>
            <td><?php echo $entity->getName() ?></td>
            <td style="width: 100px;">
                <a title="Modificar" href="/adminBlog/editTag/<?php echo $entity->getId() ?>" class="btn btn-xs btn-default">
                    <i class="glyphicon glyphicon-edit"></i>
                </a>
                <a title="Eliminar" href="/adminBlog/deleteTag/<?php echo $entity->getId() ?>" class="btn btn-xs btn-danger">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div>
    <p class="pull-right">
        Total de <?php echo $viewData['pager']->getItemCount() ?> tags.
    </p>
    <input type="hidden" id="pagina-sel" value="" />
    <ul class="pager">
        <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData['pager']->getPrevPage() ?>)"><i class="glyphicon glyphicon-chevron-left glyphicon glyphicon-white"></i></a></li>
        <span>pagina</span>
        <strong><?php echo $viewData['page'] ?></strong>
        <span>de <?php echo $viewData['pager']->getPageCount() ?></span>
        <li><a class="next" onclick="actualizarPagina(<?php echo $viewData['pager']->getNextPage() ?>)"><i class="glyphicon glyphicon-chevron-right glyphicon glyphicon-white"></i></a></li>
    </ul>
</div>
