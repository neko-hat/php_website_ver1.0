<?php



	error_reporting(E_ALL);

	ini_set("display_errors", 1);

	date_default_timezone_set('Asia/Seoul');



	$conn = mysqli_connect( "localhost", "yoobi", "toor", "php_db");



	if( empty( $conn ) == true ) {



	      echo ( "#############################################################################" );

              echo ( "</br> default DBMS 접속 호스트 정보가 정확하지 않습니다. </br>\n\n" );

    	      exit ( "#############################################################################" );



	} else {



	      echo ( "#############################################################################" );

    	      echo ( "</br> default DBMS 접속에 성공하였습니다. </br>\n\n" );

    	      echo ( "-----------------------------------------------------------------------------" );

    	      echo ( "<pre>" );

    	      print_r ( $conn );

    	      echo ( "</pre>" );

    	      exit ( "#############################################################################" );



	}

	

	mysqli_close( $conn );

?>
