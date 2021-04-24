## Interface Gráfica Auxiliar na Configuração de Filtros de Pacotes em um Ambiente Linux

 ![CheckFilter](CheckFilter.jpg "CheckFilter.jpg")

# Resumo
    Acompanhando a expansão das redes computacionais, as tecnologias
    de segurança são indispensáveis na protecão das informações e recursos de
    hardware nas redes privadas. Uma técnica segura, estável e eficaz disponível
    para ambientes GNU/Linux é o sistema de filtro de pacotes baseado no conjunto
    de ferramentas Netfilter, configurado pelo iptables através de linhas de código,
    tarefa que requer conhecimento técnico e criteriosa análise. Projetando um ambiente
    centrado no usuário para configuração, identificou-se a possibilidade de
    desenvolver uma interface gráfica que auxilie a configuração das regras otimizando
    o tempo de sua implantacão e melhorando seu gerenciamento.

# Introdução

    Atualmente, na rede mundial de computadores, existem incontáveis processos em andamento
    que são sigilosos, ou seja, somente a origem e o destino destes dados e informacões
    devem ter conhecimento de seu conteúdo, no entanto, para que tais dados sejam protegidos
    torna-se imprescindível a aplicação de métodos e tecnologias flexíveis, versáteis e
    que tornem as redes privadas mais seguras contra ataques de _crackers_ oriundos da rede
    externa.
    O componente de filtragem de pacotes tem por função analisar todos os pacotes
    que trafegam na rede por meio de regras previamente configuradas, corrigindo e/ou
    minimizando vulnerabilidades existentes, proporciona maior flexibilidade e controle ao
    administrador, é extremamente útil em situações simples de segurança visto que atua no
    bloqueio global de tipos específicos de pacotes que trafegam entre redes e no bloqueio
    de serviços. Sua implantaçao é de baixo custo, causa pouco impacto no desempenho,
    fornece controle de acesso e serviços para toda a rede.
    Acoplado ao Kernel dos Sistemas Operacionais GNU/Linux com versões 2.4
    ou superiores o subsistema de filtro de pacotes nativo denominado _Netfilter_ permite a
    configuração de regras que atuarão no bloqueio ou liberação de tráfego de pacotes na rede,
    e, para executá-las corretamente, requer conhecimento técnico e experiência de quem as
    configura, pois podem ocorrer diversos tipos de erros durante a sintaxe das regras que
    seguem uma lógica e uma padronização.
    Tomado o conhecimento destes parâmetros identificou-se a possibilidade de desenvolver
    uma aplicacão _localhost_ que auxilie na configuração e na aplicação dos filtros
    que atuarão no controle automático do tráfego da rede. Por meio de uma uma _interface_
    simples, amigável e intuitiva, esta apresentará opções de configuração dinâmica e objetiva,
    reduzindo assim o tempo de configuração de um _firewall iptables_.