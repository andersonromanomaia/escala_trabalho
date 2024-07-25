# escala_trabalho
Sistema para apresentação de controle de Escala de Domingo

# Aplicação Web de Visualização de Escalas de Domingo

# Descrição do projeto

O objetivo desse projeto é construir uma aplicação web para mostrar a escala de trabalho de alguns funcionários aos domingos.

Cada funcionário precisa trabalhar um número de domingos seguidos antes de ter uma folga obrigatória. Esse número é chamado de ciclo. Exemplos:
• Ciclo 2 (ou 2x1): trabalha 2 domingos seguidos, folga 1, depois repete
• Ciclo 3 (ou 3x1): trabalha 3 domingos seguidos, folga 1, depois repete
• Ciclo 0 (ou folga fixa de domingo): folga todo domingo

A aplicação deve consumir um arquivo CSV que contém as informações dos funcionários e seus respectivos ciclos, além da data da última folga de domingo de cada um.
Abaixo segue um descritivo das colunas do arquivo:
1. matricula: número inteiro que identifica o funcionário
2. nome: nome do funcionário
3. filial_codigo: número inteiro que identifica a filial do funcionário
4. ciclo: número inteiro que representa o ciclo de domingo do funcionário (0, 1, 2 ou 3)
5. ultima_folga: data da última folga de domingo do funcionário no formato dd/mm/aaaa

Abaixo seguem as páginas que a aplicação deve ter:
A - Tela de consumo
Essa página deve permitir que o usuário faça o upload do arquivo CSV. Após o upload, a aplicação deve armazenar o conteúdo em um banco de dados e mostrar uma mensagem com informações que você achar relevante (erro, sucesso, quantidade de registros etc.).

B - Tela de visualização
Essa página deve pedir 3 inputs ao usuário: ano, mês e código da filial. A partir disso, deve mostrar uma tabela com os domingos do mês escolhido e os funcionários da filial escolhida, indicando quem vai trabalhar e folgar.

# Desenvolvimento
A aplicação está em Laravel no backend e Vue.js no frontend, banco de dados MySQL.
