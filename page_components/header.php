<nav class="navbar">

    <div class="navbar-section">
        <div class="navbar-item">
            <a href="/auth_test/">Главная</a>
        </div>
    </div>
    <div class="navbar-section">
        <div class="navbar-item">
        <?php if (isset($_SESSION['login_user'])): ?>
            <a href="/auth_test/auth_handling/logout.php/">Выйти</a>
        <?php else: ?>
            <a href="">Войти</a>
        <?php endif; ?>
        </div>
    </div>
</nav>
