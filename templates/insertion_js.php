<script src="../static/js/popup_connexion.js">
</script>
<script>
    var menuButton = document.querySelector('.menu-button');
    var aside = document.querySelector('aside');

    menuButton.addEventListener('click', function() {
        aside.classList.toggle('open');
        menuButton.classList.toggle('rotate');
    });
</script>