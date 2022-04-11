 <main>
   <h1>Register!</h1>

   <form action="register.conn.php" method="post">
    <input type="text" name="name" placeholder="Name" required>
    <input type="text" name="mail" placeholder="E-mail" required>
    <input type="password" name="pwd" placeholder="Password" required>
    <label for="checkbox">Are you a teacher?</label>
    <input type="checkbox" name="teacher" value="Teacher">
    <button type="submit" name="register-submit">Register</button>
   </form>

   <div class="success">
    <?php if (isset($_GET['sucess'])) echo $_GET['sucess'];?>
    </div>

 </main>
