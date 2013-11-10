<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
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
    function changeStatus() {
        if ($("[name=status]").val() == "1") {
            $("#status").addClass("has-success");
        } else {
            $("#status").removeClass("has-success");
        }
    }
    CKEDITOR.on('instanceCreated', function(event) {
        var editor = event.editor, element = editor.element;
        editor.on('configLoaded', function() {
            editor.config.removePlugins = 'colorbutton,find,flash,newpage,removeformat,smiley,specialchar,templates, forms, scayt, save, preview, print, pagebreak';
            editor.config.toolbarGroups = [
                {name: 'clipboard', groups: ['clipboard', 'undo']},
                {name: 'links'},
                {name: 'insert'},
                {name: 'tools'},
                {name: 'document', groups: ['mode']},
                {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
                '/',
                {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
                {name: 'styles'},
                {name: 'colors'}
            ];
        });
    });
    
    function removeVideo(obj){
        $(obj).parent().remove();
    }
        

    $(document).ready(function() {
        changeStatus();
        CKEDITOR.replace('description', {width: "500"});
    });
</script>

<ol class="breadcrumb">
    <li><a href="/admin">Inicio</a></li>
    <li><a href="/adminProduct/index">Productos</a></li>
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
                <label class="col-md-3 control-label" for="name">Nombre</label>
                <div class="col-md-8">
                    <input type="text" name="name" id="name" class="form-control" value="<?php echo $viewData["product"]->getName() ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="description">Descripción</label>
                <div class="col-md-8">
                    <textarea type="text" name="description" id="description" class="form-control" >
                        <?php echo $viewData["product"]->getDescription() ?>
                    </textarea>
                </div>
            </div>
            <div class="form-group" id="status">
                <label class="col-md-3 control-label" for="status">Estado</label>
                <div class="col-md-8">
                    <select class="form-control" name="status" onchange="changeStatus();">
                        <option value="0" <?php echo ($viewData["product"]->getStatus() == "0" ? "selected" : "") ?> >inactivo</option>
                        <option value="1" <?php echo ($viewData["product"]->getStatus() == "1" ? "selected" : "") ?> >activo</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-md-3 control-label">Categorías</label>
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
                <button class="btn btn-lg btn-primary">Guardar</button>
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

