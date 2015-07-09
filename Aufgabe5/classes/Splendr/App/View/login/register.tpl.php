<?php
    use Splendr\App\Controller\LoginController;
    use \Splendr\Core\Helper\Notification;
    use Splendr\Core\Helper\URL;
    use Splendr\App\Model\User;

    $user = $this->getData(LoginController::USER_PARAM, new User());
?>

<div class="container">

    <?php Notification::show(); ?>

    <div class="row">
       <div class="col-sm-12 col-sm-offset-6">
           <h2>Register your new account.</h2>
       </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form class="form-horizontal" method="POST" action="<?= URL::getControllerURL('login', 'register') ?>">
                <div class="form-group">
                    <label for="username" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?= $user->getUsername() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?= $user->getEmail() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="first_name" class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?= $user->getFirstName() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="last_name" class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="<?= $user->getLastName() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="<?= $user->getPassword() ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password_confirm" class="col-sm-2 control-label">Password Confirm</label>
                    <div class="col-sm-10">
                        <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Password Confirm" value="">
                    </div>
                </div>

                <div class="form-group pull-right">
                    <button type="submit" class="btn btn-primary">Register Account</button>
                </div>
            </form>
        </div>
    </div>


</div>