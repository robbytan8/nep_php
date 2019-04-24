<?php
$submitted = filter_input(INPUT_POST, 'btnLogin');
if (isset($submitted)) {
    $username = filter_input(INPUT_POST, 'txtUsername');
    $password = filter_input(INPUT_POST, 'txtPassword');
    $md5Password = md5($password);
    $result = login($username, $md5Password);
    if ($result['rnip'] != '') {
        $_SESSION['user_abc'] = TRUE;
        $_SESSION['NIP'] = $result['rnip'];
        $_SESSION['FullName'] = $result['rfname'] . ' ' . $result['rlname'];
        header("location:index.php");
    }
}
?>

<form class="" method="post">
    <fieldset>
        <legend>Login Form</legend>
        <div class="row-input">
            <label for="txtUsernameId">Username</label>
            <input id="txtUsernameId" type="text" name="txtUsername" autofocus placeholder="e.g. santi.gunawan" required class="form-input">
        </div>
        <div class="row-input">
            <label for="txtPasswordId">Password</label>
            <input id="txtPasswordId" type="password" name="txtPassword" placeholder="e.g. password" required class="form-input">
        </div>
        <div class="">
            <input type="submit" name="btnLogin" value="Login" class="button button-primary">
        </div>
    </fieldset>
</form>
