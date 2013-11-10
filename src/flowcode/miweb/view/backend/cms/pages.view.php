<script type="text/javascript">
    $(document).ready(function() {
        $("#search").focus();
    });
    function actualizarPagina(valor) {
        $('#pagina-sel').val(valor);
        actualizarLista();
    }
    function actualizarLista() {
        var paginaSel = $('#pagina-sel').val();

        var url = "/adminPage/pages";
        if (paginaSel) {
            url += "/page/" + paginaSel.toLowerCase();
        }
        window.location = url;
    }
    function createPage() {
        $("#selectpage").modal();
    }
</script>

<ol class="breadcrumb">
    <li><a href="/admin">Inicio</a></li>
    <li class="active">Páginas</li>
</ol>

<div class="page-header">
    <h1>Paginas
        <a class="btn btn-default create" onclick="createPage();"><li class="glyphicon glyphicon-plus "></li> Nueva</a>
    </h1>
</div>

<?php echo (isset($viewData["message"]) ? $viewData["message"] : ""); ?>

<form action="/adminPage/pages" method="post" class="form-inline">
    <div class="form-group">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="form-control" value="<?php echo $viewData['filter'] ?>"/>
    </div>
    <button type="submit"class="btn btn-default"><li class="glyphicon glyphicon-search"></li> Buscar</button>
</form>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Permalink</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <?php foreach ($viewData["pager"]->getItems() as $entidad): ?>
        <tr>
            <td><div><?php echo $entidad->getId() ?></div></td>
            <td><?php echo $entidad->getName() ?></td>
            <td><?php echo $entidad->getPermalink() ?></td>
            <td><div style = "width: 300px; height: 35px; overflow: hidden;"><?php echo $entidad->getDescription() ?></div></td>
            <td><?php echo $entidad->getStatus() ?></td>
            <td><?php echo $entidad->getType() ?></td>
            <td>
                <a title="Editar" href="/adminPage/edit/id/<? echo $entidad->getId() ?>" class="btn btn-xs btn-default" >
                    <i class="glyphicon glyphicon-edit "></i>
                </a>
                <a title="Eliminar" href="<? echo "/adminPage/delete/id/" . $entidad->getId() ?>" class="btn btn-xs btn-danger" onclick="if (confirm('Estás seguro?'))
                return true;
            else
                return false;" >
                    <i class="glyphicon glyphicon-remove"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p class="pull-right">
    Total de <?php echo $viewData['pager']->getItemCount() ?> paginas.
</p>
<input type="hidden" id="pagina-sel" value="" />
<ul class="pager">
    <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData['pager']->getPrevPage() ?>)"><i class="glyphicon glyphicon-chevron-left "></i></a></li>
    <span>pagina</span>
    <strong><?php echo $viewData['page'] ?></strong>
    <span>de <?php echo $viewData['pager']->getPageCount() ?></span>
    <li><a class="next" onclick="actualizarPagina(<?php echo $viewData['pager']->getNextPage() ?>)"><i class="glyphicon glyphicon-chevron-right "></i></a></li>
</ul>

<div class="modal fade" id="selectpage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tipo de Página</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="well well-sm">
                            <h4>Pagina simple</h4>
                            <p>Página básica, ideales para contenido estático donde mostrar texto.</p>
                            <a class="btn btn-default btn-block" href="/adminPage/createSimple">Crear</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well well-sm">
                            <h4>Lista de páginas</h4>
                            <p>Página que contiene un listado de otras páginas</p>
                            <a class="btn btn-default btn-block" href="/adminPage/createList">Crear</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well well-sm">
                            <h4>Galería de imágenes</h4>
                            <p>Página para mostrar una determinada galería de imagenes</p>
                            <a class="btn btn-default btn-block" href="/adminPage/createGallery">Crear</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
