<?php
$title = 'login or sign up';
ob_start();
?>
<div class="col-xs-6">
    <h1>Log in</h1>
    <hr>
    <form action="index.php?action=login" method="POST">
        <div class="row">
        <div class="form-group col-xs-10">
            <label for="emailAddress">Email Address: </label>
            <input type="email" name="emailAddress" class="form-control" id="emailAddress">
        </div>
        </div>
        <div class="row">
        <div class="form-group col-xs-10">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        </div>
        <input type="submit" name="logIn" class="btn btn-primary" value="Log in">
    </form>
</div>
<div class="shadowBox col-xs-6">
    <h1>Create a new account</h1>
    <hr>
    <form action="index.php?action=createAccount" method="POST">
        <div class="row">
            <div class="form-group col-xs-6">
                <label for="firstName">First name: </label>
                <input type="text" name="firstName" class="form-control" id="firstName">
            </div>
            <div class="form-group col-xs-6">
                <label for="surname">Surname: </label>
                <input type="text" name="surname" class="form-control" id="surname">
            </div>
        </div>
        <div class="row">
        <div class="form-group col-xs-12">
            <label for="email">Email address: </label>
            <input type="email" name="emailAddress" class="form-control" id="email">
        </div>
        </div>
        <div class="row">
        <div class="form-group col-xs-12">
            <label for="password">Password: </label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Create Account">
    </form>
</div>

<?php
$content = ob_get_clean();
require('view/templateFront.php');
?>