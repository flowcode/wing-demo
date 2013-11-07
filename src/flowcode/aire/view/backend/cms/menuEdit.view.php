<script type="text/javascript">

    function guardarOrden() {
        var itemsArray = new Array();
        var itemMenus = $(".item-menu");
        for (var l = 0; l < itemMenus.length; l++) {
            var item = {
                id: $(itemMenus[l]).attr("data-menu-item"),
                orden: l
            }
            itemsArray.push(item);
        }
        $.ajax({
            url: "/adminMenu/saveItemsOrder",
            type: "POST",
            data: {items: itemsArray},
            success: function(data) {
                if (data === "ok") {
                    sayToUser("success", "Se guardo con éxito.")
                }
            },
            error: function(a, b, c) {
                sayToUser("error", "Algo no salió como se esperaba");
                console.log(a);
            }
        });
    }

    function deleteItem(obj) {
        var id = $(obj).parent(".item-menu").attr("data-menu-item");
        if (id.length > 0) {
            var url = "/adminMenu/deleteItemMenu";
            url += "/id/" + id;
            $.ajax({
                url: url,
                type: "html",
                success: function(data) {
                    $(obj).parent().remove();
                    sayToUser("success", "Eliminado");
                },
                error: function() {
                    sayToUser("error", "No pudo ser eliminado");
                }
            });
        } else {
            $(obj).parent().remove();
        }
    }

    function getItem(fatherId) {
        var itemHtml = "<div data-menu-item='' data-menu-father='" + fatherId + "' class='item-menu editable' >";
        itemHtml += "<span><i class='glyphicon glyphicon-move'></i></span>";
        itemHtml += '<div class="item-menu-name editable" onclick="editContent(this);" contentEditable="true">Click para cambiar el nombre</div>';
        itemHtml += '<input type="text" class="item-menu-link editable" onclick="editContent(this);" placeholder="Url del link..." />';
        itemHtml += '<a onclick="deleteItem(this)"><li class="glyphicon glyphicon-remove"></li></a>';
        itemHtml += '<a onclick="addChildItem(this);"><li class="glyphicon glyphicon-plus"></li></a>';
        itemHtml += '<div class="sortable childs"></div>';
        itemHtml += "</div>";
        return itemHtml;
    }
    function addItem() {
        $("#items").append(getItem());
    }
    function addChildItem(obj) {
        var child = getItem($(obj).parent(".item-menu").attr("data-menu-item"));
        $(obj).next(".childs").append(child);
    }
    function editContent(obj) {
        $(obj).focusout(function() {
            var parentItem = $(obj).parent(".item-menu");
            $.ajax({
                url: "/adminMenu/saveItemMenu",
                type: "post",
                data: {
                    id: parentItem.attr("data-menu-item"),
                    name: parentItem.children(".item-menu-name").html(),
                    linkurl: escape(parentItem.children(".item-menu-link").val()),
                    fatherId: parentItem.attr("data-menu-father"),
                    menuId: $("#menu-id").val()
                },
                success: function(savedId) {
                    parentItem.attr("data-menu-item", savedId);
                    sayToUser("success", "guardado");
                },
                error: function() {
                    sayToUser("error", "guardado");
                }
            });
        });
    }
    $(document).ready(function() {
//        $("#menuForm").submit(function() {
//            guardarOrden();
//        });
        $(".sortable").sortable({cursor: "move", cancel: ".editable"});
    });
</script>
<style>
    .item-menu{
        border: 1px solid darkgray;
        padding: 5px;
        width: 90%;
        margin: 5px auto auto 5%;
        background-color: white;
        border-radius: 3px;
    }
    .item-menu-link{
        margin: 0px !important;
        width: 40%;
    }
    iglyphicon glyphicon-move{
        cursor: move;
    }
    .item-menu-name{
        display: inline-block;
        width: 40%;
        margin-left: 5px;
        margin-right: 10px;
    }
    .item-menu a{
        float: right;
        cursor: pointer;
        margin-right: 10px;
    }
    .item-menu-hijo{
        width: 500px;
        margin-left: 10px;
        background-color: #B8E834;
    }
</style>
<div class="page-header">
    <h1>Modificar menu</h1>
</div>
<div>
    <form action="/adminMenu/save" method="post" id="menuForm">

        <input type="hidden" name="id" id="menu-id" value="<? echo $viewData['menu']->getId() ?>" />

        <div class="form-group">
            <label class="control-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="<? echo $viewData['menu']->getName() ?>"/>
        </div>
        <div class="well">
            <h4>Items</h4>
            <div id="items" class="sortable">
                <? foreach ($viewData['items'] as $item): ?>
                    <div class="item-menu parent" data-menu-item='<? echo $item->getId() ?>'>
                        <span><i class="glyphicon glyphicon-move"></i></span>
                        <div class="item-menu-name editable" onclick="editContent(this);" contenteditable="true"><? echo $item->getName() ?></div>
                        <input type="text" class="item-menu-link editable" onclick="editContent(this);" placeholder="Url del link..." value="<? echo $item->getLinkUrl() ?>" />
                        <a onclick="deleteItem(this)"><li class="glyphicon glyphicon-remove"></li></a>
                        <a onclick="addChildItem(this);"><li class='glyphicon glyphicon-plus'></li></a>
                        <div class="sortable childs">
                            <? foreach ($item->getSubItems() as $subitem): ?>
                                <div class="item-menu item-menu-hijo" data-menu-item='<? echo $subitem->getId() ?>'>
                                    <span><i class="glyphicon glyphicon-move"></i></span>
                                    <div class="item-menu-name editable" onclick="editContent(this);"><? echo $subitem->getName() ?></div>
                                    <input type="text" class="item-menu-link editable" onclick="editContent(this);" placeholder="Url del link..." value="<? echo $subitem->getLinkUrl() ?>" />
                                    <a onclick="deleteItem(this)"><li class="glyphicon glyphicon-remove"></li></a>
                                    <a onclick="addChildItem(this);"><li class="glyphicon glyphicon-edit"></li></a>
                                    <div class="sortable childs"></div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <a class="btn" onclick="addItem();"><li class='glyphicon glyphicon-plus-sign'></li>nuevo item</a>
        </div>

        <div class="row">
            <hr/>
            <div class="form-group col-md-6">
                <div class="col-md-3"></div>
                <div class="col-md-8">
                    <button class="btn btn-lg btn-success" type="button" onclick="guardarOrden();">Guardar</button>
                    <a class="btn btn-lg btn-default" href="/adminMenu/index" >Cancelar</a>
                </div>
            </div>
        </div>
    </form>
</div>