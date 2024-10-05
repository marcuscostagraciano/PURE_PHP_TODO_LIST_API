# _API REST_ de uma lista _To-Do_ em _PHP_ Puro

[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md)
[![pt-BR](https://img.shields.io/badge/lang-pt--BR-green.svg)](README.pt-BR.md)

[![Static Badge](https://img.shields.io/badge/apache-2.4.59-red?logo=apache)](https://apache.org/)
[![Static Badge](https://img.shields.io/badge/mysql-8.3.0-cyan?logo=mysql)](https://www.mysql.com/)
[![Static Badge](https://img.shields.io/badge/php-8.2.18-blue?logo=php)](https://www.php.net/)

## Conteúdo

-   [Propósito do projeto](#propósito-do-projeto)
-   [Esquema do Projeto](#esquema-do-projeto)
-   [Exemplos de uso (_prints_)](#exemplos-de-uso-prints)

### Proposta e Propósito do projeto

A proposta deste projeto é criar uma _API REST_, usando puramente da linguagem _PHP_ (e, evidentemente, _SQL_). Este projeto tem como finalidade principal: revisar e aprofundar conhecimentos sobre PHP e _APIs REST_, explorando suas particularidades, usos e práticas de desenvolvimento. A implementação será realizada com as ferramentas disponíveis na instalação padrão do _PHP_, sem o uso de bibliotecas ou _frameworks_.

### Esquema do Projeto

<img src="docs/backend_doc.jpg" alt="Esquema do Projeto" title="Esquema do Projeto">

### Exemplos de uso (_prints_)

-   Criação de tarefas (Método _HTTP POST_)
    <img src="docs/POST_task.png" alt="Criação de uma nova tarefa" title="Criação de uma nova tarefa">
-   Consulta de tarefas (Método _HTTP GET_)
    <img src="docs/GET_taskS.png" alt="Consulta de todas as tarefas registradas" title="Consulta de todas as tarefas registradas">
-   Consulta de tarefa (Método _HTTP GET_ + _Id_)
    <img src="docs/GET_task.png" alt="Consulta de uma tarefa específica" title="Consulta de uma tarefa específica">
-   Alteração de tarefa (Método _HTTP PATCH_)
    <img src="docs/TOGGLE_task_isDone.png" alt="Alteração do campo 'isDone' de uma tarefa específica" title="Alteração do campo 'isDone' de uma tarefa específica">
-   Exclusão de tarefa (Método _HTTP DELETE_)
    <img src="docs/DELETE_task.png" alt="Alteração do campo 'isDone' de uma tarefa específica" title="Alteração do campo 'isDone' de uma tarefa específica">
-   Consulta de tarefas após aplicação dos métodos _PATCH_ e _DELETE_ (Métodos _HTTP_: _DELETE, PATCH & GET_)
    <img src="docs/GET_taskS_after_patch_and_delete.png" alt="Consulta de todas as tarefas registradas" title="Consulta de todas as tarefas registradas">
