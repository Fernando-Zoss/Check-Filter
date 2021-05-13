<?php

    if(isset($_POST['aplicar'])){
      $protocolo1 = $_POST['protocolo1'];
      $protocolo2 = $_POST['protocolo2'];
      $portas1 = $_POST['portas1'];
      $portas2 = $_POST['portas2'];
      $portae1 = $_POST['portae1'];
      $portae2 = $_POST['portae2'];
      $interface = $_POST['interface'];
      $TOS1 = $_POST['TOS1'];
      $TOS2 = $_POST['TOS2'];


      if(isset($_POST['ACCEPT'])) {
          shell_exec("sudo iptables -P INPUT ACCEPT");
          shell_exec("sudo iptables -P OUTPUT ACCEPT");
          shell_exec("sudo iptables -P FORWARD ACCEPT");
          shell_exec("sudo iptables -P PREROUTING ACCEPT");
          shell_exec("sudo iptables -P POSTROUTING ACCEPT");
          echo '<script type="text/javascript"> alert("Politica accept selecionada !"); window.location.href="tabelaMangle.html"</script>';
        }
        else if(isset($_POST['DROP'])) {
          shell_exec("sudo iptables -P INPUT DROP");
          shell_exec("sudo iptables -P OUTPUT DROP");
          shell_exec("sudo iptables -P FORWARD DROP");
          shell_exec("sudo iptables -P PREROUTING DROP");
          shell_exec("sudo iptables -P POSTROUTING DROP");
          echo '<script type="text/javascript"> alert("Politica drop selecionada !"); window.location.href="tabelaMangle.html"</script>';
        }

//---------------------------------------TRAFEGO DE SAÍDA------------------------------------------//

        if(($protocolo1 != "") && ($portas1 != "") && ($portas2 == "") && ($TOS1 != "")){
          $regra = "iptables -t mangle -A OUTPUT -o ppp0 -p " . $protocolo1 . " --dport " . $portas1 . " -j TOS --set-tos " . $TOS1;
          echo $regra;
          shell_exec("sudo $regra");
          echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaMangle.html" </script>';
        }
        elseif (($protocolo1 != "") && ($portas1 != "") && ($portas2 != "") && ($TOS1 != "")) {

        	$regra = "iptables -t mangle -A OUTPUT -o ppp0 -p " . $protocolo1 . " --dport " . $portas1 . ":" . $portas2 . " -j TOS --set-tos " . $TOS1;
	          echo $regra;
	          shell_exec("sudo $regra");
	       echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaMangle.html" </script>';
        } 
//---------------------------------------TRAFEGO DE ENTRADA-----------------------------------------//

        elseif (($interface != "") && ($protocolo2 != "") && ($portae1 != "") && ($portae2 != "") && ($TOS2 != "")){
        	$regra = "iptables -t mangle -A PREROUTING -i " . $interface . " -p " . $protocolo2 . " --sport " . $portae1 . ":" . $portae2 . " -j TOS --set-tos " . $TOS2;
        	echo $regra;
	        shell_exec("sudo $regra");
	        echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaMangle.html" </script>';
         
        }      
    }
?>