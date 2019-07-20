<footer>
    <ul class="footer_banner menu_banner">
      <li><a href="../index.php">Home</a>&nbsp;&nbsp;|</li>
      <li>&nbsp;&nbsp;<a href="../about.php">About Ticketwire</a></li>
      <div class="right">
        <li class="right"><a href="../help.php">Help</a>&nbsp;&nbsp;</li>
        <?php if (ISSET($_SESSION['email'])): ?>
          <li class="right">|&nbsp;&nbsp;<a href="../logout.php"><button>Logout</button></a></li>
        <?php endif;?>
      </div>
    </ul>
  <p class="Ticketwire-copyright">&copy; <?php echo date("Y"); ?> Ticketwire</p>
</footer>
</body>
</html>