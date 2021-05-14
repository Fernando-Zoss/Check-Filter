 <?php
	//------------------------------ LIMPAR TABELAS ------------------------------//
	
	if(isset($_POST['lFilter'])){
		shell_exec("sudo iptables -t filter -F");
		echo '<script type="text/javascript"> alert("Todas as regras da tabela FILTER foram apagadas !"); window.location.href="Consulta.html" </script>';	
	}

	if(isset($_POST['lNat'])){
		shell_exec('sudo iptables -t nat -F');
		echo '<script type="text/javascript"> alert("Todas as regras da tabela NAT foram apagadas !"); window.location.href="Consulta.html" </script>';	
	}

	if(isset($_POST['lMangle'])){
		shell_exec('sudo iptables -t mangle -F');
		echo '<script type="text/javascript"> alert("Todas as regras da tabela MANGLE foram apagadas !"); window.location.href="Consulta.html" </script>';	
	}

	if(isset($_POST['lTodas'])){
		shell_exec("sudo iptables -t filter -F");
		shell_exec('sudo iptables -t nat -F');
		shell_exec('sudo iptables -t mangle -F');
		echo '<script type="text/javascript"> alert("Todas as regras de todas as tabelas foram apagadas !"); window.location.href="Consulta.html" </script>';	
	}

	//------------------------------ EXCLUIR REGRA ESPECÍFICA ------------------------------//
	
	if(isset($_POST['excluir'])){
     	$tabela = $_POST['tabela'];
     	$chain = $_POST['chain'];
     	$linha = $_POST['linha'];

    if (($tabela != "") && ($chain != "") && ($linha != ""))  {
	  $regra = "iptables -t " . $tabela ." -D " . $chain . " " . $linha;
	  
	  shell_exec("sudo $regra");
	  echo '<script type="text/javascript"> alert("Regra excluída com sucesso !"); window.location.href="Consulta.html" </script>';
	}
}

	//------------------------------ SALVAR ------------------------------//

	if(isset($_POST['salvar'])){
        $save = 'service netfilter-persistent save';
        shell_exec("sudo service netfilter-persistent save");
        
	 	echo '<script type="text/javascript"> alert(" As configurações do filtro de pacotes foram salvas com sucesso !"); window.location.href="Consulta.html" </script>';
    }
 ?>
