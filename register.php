<?php 

include('includes/header.php'); 

?> 

<main class="container"> 
    <h2>Register</h2> 
    <form method="post" action="register_handler.php"> 
        <label>Name</label>
        <input type="text" name="name" required><br> 
        <label>Email</label>
        <input type="email" name="email" required><br> 
        <label>Password</label>
        <input type="password" name="password" required><br> 
        <button type="submit">Register</button> 
    </form> 
</main> 

<?php 
include('includes/footer.php'); 
?>