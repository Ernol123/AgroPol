<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agropol | Strona Główna</title>
    <link rel="icon" href="./github/logo.jpg" type="image/jpg" />
    <link rel="stylesheet" href="./css/style.css" />
    <script src="https://kit.fontawesome.com/74557bc5d4.js" crossorigin="anonymous"></script>
</head>
<style>
    html {
        height: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }

    .login-box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        padding: 40px;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, .5);
        box-sizing: border-box;
        box-shadow: 0 15px 25px rgba(0, 0, 0, .6);
        border-radius: 10px;
    }

    .login-box h2 {
        margin: 0 0 30px;
        padding: 0;
        color: #fff;
        text-align: center;
    }

    .login-box .user-box {
        position: relative;
    }

    button {
        background: none;
        border: none;
    }

    .error {
        color: tomato;
    }

    .login-box .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .login-box .user-box label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
        top: -20px;
        left: 0;
        color: rgb(169, 224, 21);
        font-size: 12px;
    }

    .login-box form button {
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: rgb(169, 224, 21);
        font-size: 16px;
        text-decoration: none;
        text-transform: uppercase;
        overflow: hidden;
        transition: .5s;
        margin-top: 40px;
        letter-spacing: 4px
    }

    .login-box button:hover {
        background: rgb(169, 224, 21);
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 0 5px rgb(169, 224, 21),
            0 0 10px rgb(169, 224, 21),
            0 0 20px rgb(169, 224, 21),
            0 0 30px rgb(169, 224, 21);
    }

    .login-box button span {
        position: absolute;
        display: block;
    }

    .login-box button span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, rgb(169, 224, 21));
        animation: btn-anim1 1s linear infinite;
    }

    @keyframes btn-anim1 {
        0% {
            left: -100%;
        }

        50%,
        100% {
            left: 100%;
        }
    }

    .login-box button span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, rgb(169, 224, 21));
        animation: btn-anim2 1s linear infinite;
        animation-delay: .25s
    }

    @keyframes btn-anim2 {
        0% {
            top: -100%;
        }

        50%,
        100% {
            top: 100%;
        }
    }

    .login-box button span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(270deg, transparent, rgb(169, 224, 21));
        animation: btn-anim3 1s linear infinite;
        animation-delay: .5s
    }

    @keyframes btn-anim3 {
        0% {
            right: -100%;
        }

        50%,
        100% {
            right: 100%;
        }
    }

    .login-box button span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, rgb(169, 224, 21));
        animation: btn-anim4 1s linear infinite;
        animation-delay: .75s
    }

    @keyframes btn-anim4 {
        0% {
            bottom: -100%;
        }

        50%,
        100% {
            bottom: 100%;
        }
    }
</style>

<body>
    <nav>
        <div class="logo">AGRO<span>POL</span></div>
        <div class="nav_items">
            <a href="./index.html" class="active">Strona Główna</a>
            <a href="./items.php">Sklep</a>
            <a href="./cart.php">Koszyk</a>
            <a href="./form.html">Dodaj</a>
        </div>
        <div class="login">
            <i class="fa-solid fa-user"></i>
            <a href="./login.php">Logowanie</a>
            <a href="./php/logout.php">Wyloguj</a>

        </div>
    </nav>

    <main>
        <div class="login-box">
            <h2>Logowanie</h2>
            <form method="post" action="./php/login.php">
                <div class="user-box">
                    <input type="text" name="email">
                    <label>Email</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password">
                    <label>Hasło</label>
                </div>
                <p class="error"><?= $_GET['error'] ?? null ?></p>
                <button type="submit">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Zaloguj
                </button>
            </form>
        </div>
    </main>
</body>

</html>