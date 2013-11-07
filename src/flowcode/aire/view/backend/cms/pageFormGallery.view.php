<script type="text/javascript" src="/js/ckeditor/ckeditor.js"></script>
<script>

    $(document).ready(function() {

        $('#tabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        CKEDITOR.editorConfig = function(config) {
            config.language = 'es'
        };

        CKEDITOR.replace('htmlContent', {width: 700});
        elegirContenido();
    });

    function elegirContenido() {
        var tipo = $("#tipo").val();
        $(".contenido").hide();
        switch (tipo) {
            case "100":
                $("#contenido-simple").show();
                break;
            case "110":
                $("#contenido-estatico").show();
                break;
            default:
                $("#contenido-simple").show();
                break;
        }
    }
</script>

<ol class="breadcrumb">
    <li><a href="/admin">Home</a></li>
    <li><a href="/adminBlog/index">Páginas</a></li>
    <li class="active"><?php echo $viewData['action'] ?> páginas</li>
</ol>


<div class="page-header">
    <h1><?php echo $viewData['action'] ?> página</h1>
</div>

<?php echo (isset($viewData["message"]) ? $viewData["message"] : ""); ?>

<form action="<?php echo "/adminPage/save" ?>" method="post" class="form-horizontal">
    <input type="hidden" name="id"          value="<?php echo $viewData['page']->getId() ?>" />
    <input type="hidden" name="permalink"   value="<?php echo $viewData['page']->getPermalink() ?>" />
    <div class="row">
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a href="#datos-basicos-tab" data-toggle="tab"><h5>Datos b&aacute;sicos</h5></a></li>
            <li><a href="#contenido-tab" data-toggle="tab"><h5>Contenido</h5></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="datos-basicos-tab">
                <br/>
                <div class="form-group col-md-8">
                    <label class="col-md-3 control-label">Nombre</label>
                    <div class="col-md-8">
                        <input type="text" name="name" class="form-control" value="<? echo $viewData['page']->getName() ?>"/>
                    </div>
                </div>

                <div class="form-group col-md-8">
                    <label class="col-md-3 control-label">Descripcion</label>
                    <div class="col-md-8">
                        <textarea id="descripcion" class="form-control" name="description"><? echo $viewData['page']->getDescription() ?></textarea>
                    </div>
                </div>

                <div class="form-group col-md-8">
                    <label class="col-md-3 control-label">Estado</label>
                    <div class="col-md-8">
                        <select id="estado" name="status" class="form-control">
                            <?php if ($viewData['page']->getStatus() == '0'): ?>
                                <option selected="true" value="0">Borrador</option>
                                <option value="1">Publicada</option>
                            <?php endif; ?>
                            <?php if ($viewData['page']->getStatus() == '1'): ?>
                                <option value="0">Borrador</option>
                                <option selected="true" value="1">Publicada</option>
                            <?php else: ?>
                                <option value="1">Publicada</option>
                                <option value="0">Borrador</option>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="contenido-tab">
                <br/>
                <div class="form-group col-md-8">
                    <label class="col-md-3 control-label">Tipo de página</label>
                    <div class="col-md-8">
                        <select id="tipo" name="type" onchange="elegirContenido()" class="form-control">
                            <option value="100"<?php echo ($viewData['page']->getType() == "100") ? "selected" : ""; ?>>Página plana</option>
                            <option value="110"<?php echo ($viewData['page']->getType() == "110") ? "selected" : ""; ?>>Custom</option>
                        </select>
                    </div>
                </div>
                <div id="contenido-simple" class="contenido form-group col-md-8">
                    <label class="col-md-3 control-label">Contenido</label>
                    <div class="col-md-8">
                        <textarea id="contenido" name="htmlContent" id="htmlContent" class="form-control" style="width: 600px; height: 300px;"><?php echo $viewData['page']->getHtmlContent() ?></textarea>
                    </div>
                </div>
                <div id="contenido-estatico" class="contenido form-group col-md-8" style="display: none;">
                    <span class="label label-important">El tipo de seccion que eligio es propia del sistema, y su contenido se administra accediendo desde el menu.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <hr/>
        <div class="form-group col-md-8">
            <div class="col-md-3"></div>
            <div class="col-md-8">
                <button class="btn btn-lg btn-success">Guardar</button>
                <a class="btn btn-lg btn-default" href="/adminPage/pages" >Cancelar</a>
            </div>
        </div>
    </div>

</form>
