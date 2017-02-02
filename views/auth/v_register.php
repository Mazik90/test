<div id="wrapper">
    <section id="content">
        <div style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Sign Up</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="<?php echo \System\Helpers\URL::site('auth'); ?>">Sign In</a></div>
                </div>
                <div class="panel-body" >
                    <form id="signupform" class="form-horizontal" role="form" method="post">

                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger col-sm-12">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="login" class="col-md-3 control-label">Login</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="username" placeholder="Login">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lastname" class="col-md-3 control-label">Confirm password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>