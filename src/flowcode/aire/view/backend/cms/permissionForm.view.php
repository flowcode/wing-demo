<form action="/adminPermission/save" method="post" class="form-horizontal form">
    <input type="hidden" name="id" value="<?php echo $viewData['permission']->getId() ?>" />
    <div class="form-group">
        <label class="control-label" for="name">Nombre</label>
        <div class="col-lg-10">
            <input type="text" name="name" class="form-control" id="nombre" value="<?php echo $viewData['permission']->getName() ?>"/>
        </div>
    </div>

</form>

