<?php
	session_start();
        $result = session_destroy();
 
        if($result) {
?>
        <script>
                alert("Successfully signed out.");
		history.back();
        </script>
<?php   }
?>


