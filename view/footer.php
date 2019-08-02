<footer>
    <ul class="footer_menu_banner">
      <div class="left">
        <li><a href="../index.php"><span>Home</span></a></li>
        <li><a href="../about.php"><span>About Ticketwire</span></a></li>
      </div>
      <div class="right">
        <li><a href="../help.php"><span>Help</span></a></li>
        <?php if (ISSET($_SESSION['email'])): ?>
          <li><a href="../logout.php"><button>Logout</button></a></li>
        <?php endif;?>
      </div>
    </ul>
  <p class="Ticketwire-copyright">Ticketwire&nbsp;<?php echo date("Y"); ?></p>
</footer>
</body>
</html>