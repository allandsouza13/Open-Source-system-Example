<h1 class="mt-3">Login</h1>

<?php
if (!empty($message)) {
   echo '<div class="alert alert-danger" role="alert">' . $message . '</div>';
}
?>

<form name="frmLogin" action="authenticate.php" method="post" class="mt-5">
   <div class="mb-3">
      <label for="txtid" class="form-label">Student ID</label>
      <input type="text" class="form-control" id="txtid" name="txtid">
   </div>
   <div class="mb-3">
      <label for="txtpwd" class="form-label">Password</label>
      <div class="input-group">
         <input type="password" class="form-control" id="txtpwd" name="txtpwd">
         <button type="button" class="btn btn-outline-secondary" id="togglePassword">Show</button>
      </div>
   </div>
   <input type="submit" value="Login" name="btnlogin" class="btn btn-primary" />
</form>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const pwdField = document.getElementById('txtpwd');
    const pwdToggleBtn = document.getElementById('togglePassword');
    
    if (pwdField.type === 'password') {
        pwdField.type = 'text';
        pwdToggleBtn.textContent = 'Hide';
    } else {
        pwdField.type = 'password';
        pwdToggleBtn.textContent = 'Show';
    }
});
</script>
