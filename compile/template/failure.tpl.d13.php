<?php
ob_start(); /* template body */ ?><div class="form-container">
<p>Connection timed out or job not completed. You can try to reload this page in a minute or so to see if the job is finished.</p>
<p>Or you can return to the <a href="index.php">main page</a>.</p>
</div>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>