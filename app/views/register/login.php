<?php  $this->start('body'); ?>

<?= isset($this->displayErrors) ? $this->displayErrors : false ?>
<div class="card w-50 mx-auto mt-5 border-primary">
    <div class="card-body">
        <h1 class="card-title display-5 text-center text-primary">Login</h1>
        <form action="#" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control">
            </div>
            <div class="form-check">
                <input name="remember" type="checkbox" class="form-check-input">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button class="btn btn-block btn-outline-primary mt-4">Login</button>
        </form>
    </div>
</div>

<?php $this->end(); ?>