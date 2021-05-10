 <?php

//-----------------------------------------bloqueio de portas-------------------------------------//

    if(isset($_POST['aplicar'])){
      $palavra = $_POST['palavra'];
      $protocolo = $_POST['protocolo'];
      $acao = $_POST['acao'];
      $portaa = $_POST['portaa'];
      $portab = $_POST['portab'];
      $algoritmo = $_POST['algoritmo'];
        

        if(isset($_POST['ACCEPT'])) {
          shell_exec("sudo iptables -P INPUT ACCEPT");
          shell_exec("sudo iptables -P OUTPUT ACCEPT");
          shell_exec("sudo iptables -P FORWARD ACCEPT");
          echo '<script type="text/javascript"> alert("Politica accept selecionada!"); window.location.href="tabelaFilter.html"</script>';
        }
        else if(isset($_POST['DROP'])) {
          shell_exec("sudo iptables -P INPUT DROP");
          shell_exec("sudo iptables -P OUTPUT DROP");
          shell_exec("sudo iptables -P FORWARD DROP");
          echo '<script type="text/javascript"> alert("Politica drop selecionada!"); window.location.href="tabelaFilter.html"</script>';
        }

        if(($protocolo != "") && ($acao != "") && ($portaa != "") && ($portab == "")){
          $regra = "iptables -A INPUT -p " . $protocolo . " --dport " . $portaa . " -j " . $acao;
          shell_exec("sudo $regra");
          echo $regra;
          echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaFilter.html"</script>';
        }

        elseif(($protocolo != "") && ($acao != "") && ($portaa != "") && ($portab != "")) {
        	$regra = "iptables -A INPUT -p " . $protocolo . " --dport " . $portaa . ":" . $portab . " -j " . $acao;
          shell_exec("sudo $regra");
          echo $regra;
          echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaFilter.html" </script>';
        }
//------------------------------------------bloqueio de palavras ----------------------------------//        

        elseif(($algoritmo == "bm") && ($palavra != "")){
          $regra = "iptables -I FORWARD -i eth0 -m string --algo " . $algoritmo . " --string " . $palavra . " -j DROP";
          shell_exec("sudo $regra");
          echo $regra;
          echo '<script type="text/javascript"> alert("!!!"); window.location.href="tabelaFilter.html" </script>';
    }
  }
 ?>