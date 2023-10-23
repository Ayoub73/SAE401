<?php 

$general = $bdd -> query('SELECT * FROM general');

$general = $general->fetch();

$copyright = $general["copyright"];

?>

<footer id="footer">
    <!-- Copyright. -->
    <p class="copyright"><?php echo $copyright; ?></p>
</footer>