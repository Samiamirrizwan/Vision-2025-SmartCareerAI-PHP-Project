<?php 
include('includes/header.php'); 

?> 

<main class="container"> 
    <h2>Login</h2> 
    <form method="post" action="login_handler.php"> 
        <label>Email</label>
        <input type="email" name="email" required><br> 
        <label>Password</label>
        <input type="password" name="password" required><br> 
        <button type="submit">Login</button> 
    </form> 
</main> 


<?php 

include('includes/footer.php'); 

?>