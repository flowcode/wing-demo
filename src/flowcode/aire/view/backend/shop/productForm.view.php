<script type="text/javascript">
    function openKCFinder_singleFile() {
        window.KCFinder = {};
        window.KCFinder.callBack = function(url) {
            addImage(url);
            window.KCFinder = null;
        };
        window.open('/src/kcfinder/browse.php', 'Admin', 'height=500,width=600');
    }


    function addImage(imageUrl) {
        var imageTmpl = '<div class="col-md-3 col-sm-3">';
        imageTmpl += '<button type="button" class="btn btn-sm pull-right pull-right" onclick="removeImage(this);"><li class="glyphicon glyphicon-remove"></li></button>';
        imageTmpl += '<div class="thumbnail">';
        imageTmpl += '    <img src="' + imageUrl + '" height="100">';
        imageTmpl += '    <input type="hidden" name="images[]" value="' + imageUrl + '" />';
        imageTmpl += '</div>';
        imageTmpl += '</div>';
        $("#imageList").append(imageTmpl);
    }
</script>

<ol class="breadcrumb">
    <li><a href="/admin">Home</a></li>
    <li><a href="/adminProduct/index">Posts</a></li>
    <li class="active"><?php echo $viewData['action'] ?> producto</li>
</ol>

<div class="page-header">
    <h1><?php echo $viewData['action'] ?> Producto</h1>
</div>

<?php echo (isset($viewData["message"]) ? $viewData["message"] : ""); ?>

<form class="form-horizontal" action="/adminProduct/save" method="post" role="form">
    <?php if ($viewData['product']->getId() != NULL): ?>
        <input type="hidden" name="id" value="<?php echo $viewData["product"]->getId() ?>" />
    <?php endif; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label" for="name">Name</label>
                <div class="col-md-8">
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $viewData["product"]->getName() ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Description</label>
                <div class="col-md-8">
                    <input type="text" name="description" id="description" class="form-control" value="<?php echo $viewData["product"]->getDescription() ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="status">Status</label>
                <div class="col-md-8">
                    <input type="text" name="status" id="status" class="form-control" value="<?php echo $viewData["product"]->getStatus() ?>"/>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">Categorys</label>
                <div class="col-md-8">
                    <select multiple="multiple" name="categorys[]" style="height: 137px;" class="form-control">
                        <?php foreach ($viewData["categorys"] as $product): ?>
                            <?php
                            $checked = "";
                            foreach ($viewData["product"]->getCategorys() as $postCategorys) {
                                if ($product->getId() == $postCategorys->getId()) {
                                    $checked = "selected";
                                    break;
                                }
                            }
                            ?>
                            <option <?php echo $checked; ?> value="<?php echo $product->getId(); ?>" ><?php echo $product; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <hr/>
        <div class="form-group col-md-6">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <button class="btn btn-lg btn-success">Guardar</button>
                <a class="btn btn-lg btn-default" href="/adminProduct/index" >Cancelar</a>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Imágenes del producto</div>
        <div class="panel-body">
            <div class="row">
                <button type="button" class="btn btn-default" onclick="openKCFinder_singleFile();" ><i class="glyphicon glyphicon-plus"></i> Agregar imagen</button>
            </div>
            <div id="imageList" class="row">
                <?php foreach ($viewData['product']->getImages() as $image): ?>
                    <div class="col-md-3 col-sm-3">
                        <button type="button" class="btn btn-sm pull-right" onclick="removeVideo(this);"><li class="glyphicon glyphicon-remove pull-right"></li></button>
                        <div class="thumbnail">
                            <img src="<? echo $image->getPath(); ?>"  height='100'>
                            <input type='hidden' name='images[]' value='<?php echo $image->getId(); ?>' />
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</form>

