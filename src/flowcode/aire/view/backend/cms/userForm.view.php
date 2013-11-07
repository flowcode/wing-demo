<?php $edita = FALSE; ?>
<?php if ($viewData['user']->getId() && $viewData['user']->getId() != -1 && $viewData['user']->getId() != NULL): ?>
    <?php $edita = TRUE; ?>
    <form action="<?php echo "/adminUser/saveEdit" ?>" method="post" class="form-horizontal form">
        <input type="hidden" name="id" value="<?php echo $viewData['user']->getId() ?>" />
    <?php else: ?>
        <form action="<?php echo "/adminUser/save" ?>" method="post" class="form-horizontal form">
        <?php endif; ?>
        <div class="form-group">
            <label class="col-lg-2 control-label" for="name">Nombre</label>
            <div class="col-lg-10">
                <input type="text" name="name" id="nombre" class="form-control" value="<?php echo $viewData['user']->getName() ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="username">Username</label>
            <div class="col-lg-10">
                <input type="text" name="username" id="username" class="form-control" value="<?php echo $viewData['user']->getUsername() ?>"/>
            </div>
        </div>

        <div class="form-group">
            <?php if ($edita): ?>
                <label class="col-lg-2 control-label" for="password">Nuevo Password</label>
                <div class="col-lg-10">
                    <input type="password" name="password" class="form-control" id="password" value=""/>
                    <span class="label label-important">Dejar en blanco para mantener pass anterior</span>
                </div>
            <?php else: ?>
                <label class="col-lg-2 control-label" for="password">Password</label>
                <div class="col-lg-10">
                    <input type="password" name="password" class="form-control" id="password" value=""/>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Roles</label>
            <div class="col-lg-10">
                <select multiple="multiple" name="roles[]" style="height: 137px;" class="form-control">
                    <?php foreach ($viewData['roles'] as $role): ?>
                        <?php
                        $checked = "";
                        foreach ($viewData['user']->getRoles() as $postRole) {
                            if ($role->getId() == $postRole->getId()) {
                                $checked = "selected";
                                break;
                            }
                        }
                        ?>
                        <option <?php echo $checked; ?> value="<?php echo $role->getId(); ?>" ><?php echo $role; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-2 control-label" for="mail">Mail</label>
            <div class="col-lg-10">
                <input type="text" name="mail" value="<?php echo $viewData['user']->getMail() ?>" class="form-control"/>
            </div>
        </div>


    </form>

