<div class="top-bar shadow">
    <?php if (!isset($_SESSION["username"])) : ?>
        <div id="menu1" class="menu">
            <button onclick="document.getElementById('signup').style.display='block'" class="button shadow">
                Sign Up
            </button>
            <button onclick="document.getElementById('login').style.display='block'" class="button-normal">
                Log In
            </button>
        </div>
    <?php else : ?>
        <div id="menuQuittedThisJs" class="menu">
            <img class="shadow" src="/mvc/public/styles/img/icons/user.png" alt="user">
            <button onclick="document.getElementById('user-menu').style.display='block'" class="button-normal">
                <?php echo $_SESSION["username"] ?>
            </button>
        </div>
    <?php endif; ?>
</div>

<div id="user-menu" class="modal">
    <div class="user-menu-content shadow">
        <a href="/mvc/dashboard">Dashboard</a>
        <a href="/mvc/home" onclick="onLogout()">Log Out</a>
    </div>
</div>

<div id="login" class="modal">
    <div class="modal-content shadow">
        <form class="account-form" id="loginForm">
            <span onclick="document.getElementById('login').style.display='none'" class="close-button">&times;</span>
            <h2>Welcome back!</h2>
            <img class="shadow" src="/mvc/public/styles/img/icons/user.png" alt="user">
            <input class="form-field shadow" type="text" name="username" placeholder="Username" id="Usr">
            <input class="form-field shadow" type="password" name="password" placeholder="Password" id="Pass">
            <input class="shadow" type="submit" value="Log In">
        </form>
    </div>
</div>

<div id="signup" class="modal">
    <div class="modal-content shadow">
        <form class="account-form" id="signupForm">
            <span onclick="document.getElementById('signup').style.display='none'" class="close-button">&times;</span>
            <h2>Nice to meet you!</h2>
            <img class="shadow" src="/mvc/public/styles/img/icons/user.png" alt="user">
            <input class="form-field shadow" type="text" name="username" placeholder="Username" id="UserSignUp">
            <input class="form-field shadow" type="password" name="password" placeholder="Password" id="UserPasswordSignUp">
            <input class="form-field shadow" type="text" name="text" placeholder="Email" id="UserEmail">
            <input class="shadow" type="submit" value="Sign Up">
        </form>
    </div>
</div>

<script>
    var modal1 = document.getElementById('login');
    var modal2 = document.getElementById('signup');
    var userdrop = document.getElementById('user-menu');

    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = 'none';
        }

        if (event.target == modal2) {
            modal2.style.display = 'none';
        }

        if (event.target == userdrop) {
            userdrop.style.display = 'none';
        }
    }
</script>