<nav class="navbar">

    <div class="navbar-section">
        <div class="navbar-item">
            <a href="/auth_test/">Главная</a>
        </div>
    </div>
    <div class="navbar-section">
        <div class="navbar-item">
        <?php if (isset($_SESSION['login_user'])): ?>
            <a href="/auth_test/auth_handling/logout.php/" id=logout-button>Выйти</a>
        <?php else: ?>
            <a href="#" id=login-button>Войти</a>
        <?php endif; ?>
        </div>
        <div class="navbar-item">
            <a href="#" id='registration-button'>Регистрация</a>
        </div>
    </div>
</nav>
