 <?php
    
    if(isset($_POST['aplicar'])){
      $niporigem = $_POST['niporigem'];
      $interface = $_POST['interface'];
      $nat = $_POST['nat'];
      $fipinicial = $_POST['fipinicial'];
      $fipfinal = $_POST['fipfinal'];
      $politica = $_POST['politica'];
      $mascip = $_POST['mascip'];
      $redipdestino = $_POST['redipdestino'];
      $redpdestino = $_POST['redpdestino'];
      $rediporigem = $_POST['rediporigem'];
      $redporigem = $_POST['redporigem'];

      if(isset($_POST['ACCEPT'])) {
          shell_exec("sudo iptables -P INPUT ACCEPT");
          shell_exec("sudo iptables -P OUTPUT ACCEPT");
          shell_exec("sudo iptables -P PREROUTING ACCEPT");
          shell_exec("sudo iptables -P POSTROUTING ACCEPT");
          echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaNat.html"</script>';
        }
        else if(isset($_POST['DROP'])) {
          shell_exec("sudo iptables -P INPUT DROP");
          shell_exec("sudo iptables -P OUTPUT DROP");
          shell_exec("sudo iptables -P PREROUTING DROP");
          shell_exec("sudo iptables -P POSTROUTING DROP");
          echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaNat.html"</script>';
        }

      //-------------------------------------- SNAT --------------------------------------//

    	if (($niporigem != "") && ($interface != "") && ($nat == "SNAT") && ($fipinicial != "") && ($fipfinal == "")) {
    		$regra = "iptables -t nat -A POSTROUTING -s " . $niporigem . " -o " . $interface . " -j " . $nat . " --to " . $fipinicial;
        echo $regra;
        shell_exec("sudo $regra");
    	  echo '<script type="text/javascript"> alert("Regra aplicada com sucesso!"); window.location.href="tabelaNat.html" </script>';
    	}

      elseif (($niporigem != "") && ($interface != "") && ($nat == "SNAT") && ($fipinicial != "") && ($fipfinal != "")) {
        $regra = "iptables -t nat -A POSTROUTING -s " . $niporigem . " -o " . $interface . " -j " . $nat . " --to " . $fipinicial . "-" . $fipfinal;
        echo $regra;
        shell_exec("sudo $regra");
        echo '<script type="text/javascript"> alert("Regra aplicada com sucesso!"); window.location.href="tabelaNat.html" </script>';
      }

      //-------------------------------------DNAT-------------------------------------------//

      elseif (($niporigem != "") && ($interface != "") && ($nat == "DNAT") && ($fipinicial != "") && ($fipfinal == "")) {
        $regra = "iptables -t nat -A PREROUTING -s " . $niporigem . " -i " . $interface . " -j " . $nat . " --to " . $fipinicial;
        echo $regra;
        shell_exec("sudo $regra");
        echo '<script type="text/javascript"> alert("Regra aplicada com sucesso!"); window.location.href="tabelaNat.html" </script>';
      }

      elseif (($niporigem != "") && ($interface != "") && ($nat == "DNAT") && ($fipinicial != "") && ($fipfinal != "")) {
        $regra = "iptables -t nat -A PREROUTING -s " . $niporigem . " -i " . $interface . " -j " . $nat . " --to " . $fipinicial . "-" . $fipfinal;
        shell_exec("sudo $regra");
        echo '<script type="text/javascript"> alert("Regra aplicada com sucesso!"); window.location.href="tabelaNat.html" </script>';
      }

      //-------------------------------REDIRECIONAR PORTA-----------------------------------//

      elseif (($rediporigem != "") && ($redporigem != "") && ($redipdestino != "") && ($redpdestino != "")){
        $regra2 = "iptables -t nat -A PREROUTING -d " . $rediporigem . " -p tcp --dport " . $redporigem . " -j DNAT --to " . $redipdestino . ":" . $redpdestino;
        echo $regra2;
        shell_exec("sudo $regra2");
        echo '<script type="text/javascript"> alert("Regra aplicada com sucesso!"); window.location.href="tabelaNat.html" </script>';
      }

      //------------------------------- MASQUERADING -----------------------------------//

      elseif ($mascip != "") {
        $regra2 = "iptables -t nat -A POSTROUTING -s " . $mascip . " -o ppp0 -j MASQUERADE";
        $liga = "1";
        shell_exec("echo $liga >/proc/sys/net/ipv4/ip_forward");
        shell_exec("sudo $regra2");
        echo '<script type="text/javascript"> alert("Regra aplicada com sucesso!"); window.location.href="tabelaNat.html" </script>';
      }
    }
?>