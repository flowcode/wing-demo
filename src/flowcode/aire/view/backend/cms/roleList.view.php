<script type="text/javascript">
    function actualizarPagina(valor) {
        $('#pagina-sel').val(valor);
        actualizarLista();
    }
    function actualizarLista() {
        var paginaSel = $('#pagina-sel').val();
        var searchSel = $('#search').val();

        var url = "#!adminRole/index";
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

        /* create */
        $(".page-header > h1 > a").click(function() {
            createEntity("New Role", $(this).attr("data-form"), $(this).attr("data-form-action"));
        });

        /* update */
        $("a.edit").click(function() {
            updateEntity("Edit Role", "/adminRole/edit/" + $(this).attr("data-form-entity"), "/adminRole/save");
        });

        /* delete */
        $("a.delete").click(function() {
            if (confirm('Estás seguro?')) {
                deleteEntity("adminRole/delete/" + $(this).attr("data-form-entity"));
            }
        });
    });
</script>
<div class="page-header">
    <h1>Roles
        <a class="btn btn-default" data-form="/adminRole/create" data-form-action="/adminRole/save" ><i class="glyphicon glyphicon-plus glyphicon glyphicon-white"></i> Nuevo</a>
    </h1>
</div>

<div class="form-inline">
    <div class="form-group">
        <input id="search" type="text" name="search" placeholder="Buscar…" class="form-control" value="<?php echo $viewData['filter'] ?>">
    </div>
    <button type="button" class="btn btn-default" onclick="actualizarLista()" ><i class="glyphicon glyphicon-search glyphicon glyphicon-white"></i> Buscar</button>
</div>

<table class="table table-condensed">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viewData['pager']->getItems() as $entity): ?>
            <tr>
                <td><?php echo $entity->getId() ?></td>
                <td><?php echo $entity->getName() ?></div></td>
                <td style="width: 100px;">
                    <a data-form-entity="<? echo $entity->getId() ?>" class="btn btn-xs edit" ><i class="glyphicon glyphicon-edit glyphicon glyphicon-white"></i></a>
                    <a data-form-entity="<? echo $entity->getId() ?>" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-remove glyphicon glyphicon-white"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p class="pull-right">
    Total de <?php echo $viewData['pager']->getItemCount() ?> roles.
</p>
<input type="hidden" id="pagina-sel" value="" />
<ul class="pager">
    <li><a class="previous" onclick="actualizarPagina(<?php echo $viewData['pager']->getPrevPage() ?>)"><i class="glyphicon glyphicon-chevron-left glyphicon glyphicon-white"></i></a></li>
    <span>pagina</span>
    <strong><?php echo $viewData['page'] ?></strong>
    <span>de <?php echo $viewData['pager']->getPageCount() ?></span>
    <li><a class="next" onclick="actualizarPagina(<?php echo $viewData['pager']->getNextPage() ?>)"><i class="glyphicon glyphicon-chevron-right glyphicon glyphicon-white"></i></a></li>
</ul>
