<style>
    #imageList{
        display: table;
    }
    .image-container{
        float: left;
        width: 150px;
        height: 150px;
        margin: 5px;
        background-color: white;
    }
</style>
<div>
    <ul class="breadcrumb">
        <li><a href="/home">Home</a> <span class="divider">/</span></li>
        <li><a href="/product">Products</a> <span class="divider">/</span></li>
        <li class="active"><?php echo $viewData["product"]->getName() ?></li>
    </ul>
    <h1><?php echo $viewData["product"]->getName() ?></h1>
    <div>
        <?php echo $viewData["product"]->getDescription() ?>
    </div>
    <div id="imageList" class="well">
        <?php foreach ($viewData['product']->getImages() as $image): ?>
            <div class="image-container">
                <div class="image">
                    <img src="<? echo $image->getPath(); ?>"  width='95' height='95'>
                    <input type='hidden' name='images[]' value='<?php echo $image->getPath(); ?>' />
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>