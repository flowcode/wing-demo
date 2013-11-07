<div class="page-header">
    <h1>Simple Contact Form</h1>
</div>
<div class="col-md-4">
    <form role="form" class="form-horizontal">
        <div class="form-group">
            <label>Name</label>
            <?php echo $viewData["form"]->getField("name") ?>
        </div>
        <div class="form-group">
            <label>Mail</label>
            <?php echo $viewData["form"]->getField("mail") ?>
        </div>
        <div class="form-group">
            <label>Coment</label>
            <?php echo $viewData["form"]->getField("coment") ?>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-lg">Send</button>
        </div>
    </form>
</div>
