<ol class="breadcrumb">
    <li><a href="/admin">Home</a></li>
    <li><a href="/adminBlog/tags">Tags</a></li>
    <li class="active"><?php echo $viewData['action'] ?> tags</li>
</ol>


<div class="page-header">
    <h1><?php echo $viewData['action'] ?> tag</h1>
</div>

<?php echo (isset($viewData["message"]) ? $viewData["message"] : ""); ?>

<form action="/adminBlog/saveTag" method="post" class="form" role="form">
    <input type="hidden" name="id" value="<?php echo $viewData['tag']->getId() ?>" />

    <div class="row">
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">Nombre</label>
            <div class="col-md-6">
                <input type="text" id="name" class="form-control" name="name" placeholder="nombre..." value="<?php echo $viewData['tag']->getName() ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <hr/>
        <div class="form-group col-md-6">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <button class="btn btn-lg btn-success">Guardar</button>
                <a class="btn btn-lg btn-default" href="/adminBlog/tags" >Cancelar</a>
            </div>
        </div>
    </div>

</form>


