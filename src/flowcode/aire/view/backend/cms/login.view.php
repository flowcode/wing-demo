<script type="text/javascript">
    $(document).ready(function() {
        $("#login-name").focus();
    });
</script>
<div class="row well well-lg col-md-4 col-md-offset-4">

    <center>
        <img class="img-rounded" src="/images/flowcode-fav.png" alt="Welcome to Wing Demo" />
        <h3>Panel de Control</h3>
    </center>

    <form name="form" method="post" action="/adminLogin/validate" class="form-horizontal">
        <div class="form-group">
            <label class="" for="login-name"></label>
            <input type="text" class="form-control" id="login-name" placeholder="Enter your username" name="username" />
        </div>

        <div class="form-group">
            <label class="login-field-icon fui-lock-16" for="login-pass"></label>
            <input type="password" class="form-control" value="" placeholder="Password" name="password" />
        </div>

        <? if (strlen($viewData["message"]) != 0): ?>
            <div class="alert alert-error"><? echo $viewData["message"] ?></span></div>
        <? endif; ?>

        <button class="btn btn-success btn-lg btn-block" type="submit">Login</button>
    </form>
</div>
