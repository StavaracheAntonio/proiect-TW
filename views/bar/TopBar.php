<div class="top-bar">
    <div id="menu1" class="menu">
        <button onclick="document.getElementById('signup').style.display='block'" class="button shadow">
            Sign Up
        </button>
        <button onclick="document.getElementById('login').style.display='block'" class="button-normal">
            Log In
        </button>
    </div>
    <div id="menu2" class="menu">
        <img class="shadow" src="img/icons/user.png" alt="user">
        <button onclick="document.getElementById('user-menu').style.display='block'" class="button-normal">
            Andrei Raducanu
        </button>
    </div>
</div>

<div id="user-menu" class="modal">
    <div class="user-menu-content shadow">
        <a href="#">Dashboard</a>
        <a href="#">Sign out</a>
    </div>
</div>

<div id="login" class="modal">
    <div class="modal-content shadow">
        <form class="account-form" name="loginForm">
            <span onclick="document.getElementById('login').style.display='none'" class="close-button">&times;</span>
            <h2>Welcome back!</h2>
            <img class="shadow" src="styles/img/icons/user.png" alt="user">
            <input class="form-field shadow" type="text" name="username" placeholder="Username">
            <input class="form-field shadow" type="password" name="password" placeholder="Password">
            <button class="shadow" type="submit">Log In</button>
            <a href="#">Forgot Username/ Password?</a>
        </form>
    </div>
</div>

<div id="signup" class="modal">
    <div class="modal-content shadow">
        <form class="account-form" name="signupForm">
            <span onclick="document.getElementById('signup').style.display='none'" class="close-button">&times;</span>
            <h2>Nice to meet you!</h2>
            <img class="shadow" src="styles/img/icons/user.png" alt="user">
            <input class="form-field shadow" type="text" name="username" placeholder="Username">
            <input class="form-field shadow" type="password" name="password" placeholder="Password">
            <input class="form-field shadow" type="password" name="password" placeholder="Confirm password">
            <button class="shadow" type="submit">Sign Up</button>
            <a href="#">Already have an account?</a>
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