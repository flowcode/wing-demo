<script type="text/javascript">

    function actualizarPagina(valor) {
        $('#pagina-sel').val(valor);
        actualizarLista();
    }
    function actualizarLista() {
        var paginaSel = $('#pagina-sel').val();
        var searchSel = $('#search').val();

        var url = "/adminBlog/index";
        if (paginaSel) {
            url += "/page/" + paginaSel.toLowerCase();
        }
        if (searchSel) {
            url += "/search/" + encodeURI(searchSel);
        }
        window.location = url;
    }
    $(document).ready(function() {
        $("#search").focus(function() {
            $(this).keyup(function(e) {
                if (e.keyCode === 13) {
                    actualizarLista();
                }
            });
        });
        $("#search").focus();
    });
</script>

<ol class="breadcrumb">
    <li><a href="/admin">Inicio</a></li>
    <li class="active">Posts</li>
</ol>

<div class="page-header">
    <h1>Posts
        <a class="btn btn-default create" href="/adminBlog/createPost" ><i class="glyphicon glyphicon-plus glyphicon glyphicon-white"></i> Nuevo</a>
    </h1>
</div>


<div action="/adminBlog/index" method="post" class="form-inline" role="form">
    <div class="form-group">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="form-control" value="<?php echo $viewData['filter'] ?>">
    </div>
    <button type="button" class="btn btn-default" onclick="actualizarLista()" ><i class="glyphicon glyphicon-search glyphicon glyphicon-white"></i> Buscar</button>
</div>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Titulo</th> 
            <th>Descripci&oacute;n</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($viewData['pager']->getItems() as $entidad): ?>
        <tr>
            <td><?php echo $entidad->getId() ?></td>
            <td><?php echo $entidad->getTitle() ?></td>
            <td><?php echo $entidad->getDescription() ?></td>
            <td><?php echo $entidad->getDate() ?></td>
            <td>
                <a title="Editar" href="/adminBlog/editPost/<? echo $entidad->getId() ?>" class="btn btn-xs btn-default" ><li class="glyphicon glyphicon-edit glyphicon-white"></li></a>
                <a title="Eliminar" class="btn btn-xs btn-danger" href="/adminBlog/deletePost/<? echo $entidad->getId() ?>" onclick="if (confirm('Estás seguro?')) {
                return true
            }
            return false;"><li class="glyphicon glyphicon-remove glyphicon glyphicon-white"></li></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p class="pull-right">
    Total de <?php echo $viewData['pager']->getItemCount() ?> noticias.
</p>
<input type="hidden" id="pagina-sel" value="" />
<ul class="pager">
    <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData['pager']->getPrevPage() ?>)"><i class="glyphicon glyphicon-chevron-left glyphicon glyphicon-white"></i></a></li>
    <span>pagina</span>
    <strong><?php echo $viewData['page'] ?></strong>
    <span>de <?php echo $viewData['pager']->getPageCount() ?></span>
    <li><a class="next" onclick="actualizarPagina(<?php echo $viewData['pager']->getNextPage() ?>)"><i class="glyphicon glyphicon-chevron-right glyphicon glyphicon-white"></i></a></li>
</ul>
