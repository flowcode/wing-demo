<ol class="breadcrumb">
    <li><a href="/admin">Inicio</a></li>
    <li><a href="/adminProductCategory/index">Categorias</a></li>
    <li class="active"><?php echo $viewData['action'] ?> categoria</li>
</ol>

<div class="page-header">
    <h1><?php echo $viewData['action'] ?> Categoria</h1>
</div>

<?php echo (isset($viewData["message"]) ? $viewData["message"] : ""); ?>

<form class="form-horizontal" role="form" action="/adminProductCategory/save" method="post">
    <?php if ($viewData['productCategory']->getId() != NULL): ?>
        <input type="hidden" name="id" value="<?php echo $viewData["productCategory"]->getId() ?>" />
    <?php endif; ?>
    <div class="form-group">
        <label class="control-label col-md-3" for="name">Name</label>
        <div class="col-md-8">
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $viewData["productCategory"]->getName() ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3" for="description">Description</label>
        <div class="col-md-8">
            <input type="text" name="description" id="description" class="form-control" value="<?php echo $viewData["productCategory"]->getDescription() ?>"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Products</label>
        <div class="col-md-8">
            <select multiple="multiple" name="products[]" style="height: 137px;" class="form-control">
                <?php foreach ($viewData["products"] as $productCategory): ?>
                    <?php
                    $checked = "";
                    foreach ($viewData["productCategory"]->getProducts() as $postProducts) {
                        if ($productCategory->getId() == $postProducts->getId()) {
                            $checked = "selected";
                            break;
                        }
                    }
                    ?>
                    <option <?php echo $checked; ?> value="<?php echo $productCategory->getId(); ?>" ><?php echo $productCategory; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="row">
        <hr/>
        <div class="form-group col-md-6">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <button class="btn btn-lg btn-success">Guardar</button>
                <a class="btn btn-lg btn-default" href="/adminProductCategory/index" >Cancelar</a>
            </div>
        </div>
    </div>

</form>

