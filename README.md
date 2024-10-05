# Pure PHP To-Do List API

[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md)
[![pt-BR](https://img.shields.io/badge/lang-pt--BR-green.svg)](README.pt-BR.md)

[![Static Badge](https://img.shields.io/badge/apache-2.4.59-red?logo=apache)](https://apache.org/)
[![Static Badge](https://img.shields.io/badge/mysql-8.3.0-cyan?logo=mysql)](https://www.mysql.com/)
[![Static Badge](https://img.shields.io/badge/php-8.2.18-blue?logo=php)](https://www.php.net/)

## Content

-   [Project purpose](#project-purpose)
-   [Project Schema](#project-schema)
-   [Usage examples (prints)](#usage-examples-prints)

### Project purpose

The aim of this project is to create a REST API, using purely the PHP language (and, of course, SQL). The main aim of this project is to review and deepen our knowledge of PHP and REST APIs, exploring their particularities, uses and development practices. Implementation will be carried out using the tools available in the standard PHP installation, without the use of libraries or frameworks.

### Project Schema

<img src="docs/backend_doc.jpg" alt="Project Schema" title="Project Schema">

### Usage examples (prints)

-   Task creation (HTTP POST Method)
    <img src="docs/POST_task.png" alt="Creation of a new task" title="Creation of a new task">
-   Query of all registered tasks (HTTP GET Method)
    <img src="docs/GET_taskS.png" alt="Query of all registered tasks" title="Query of all registered tasks">
-   Query of a specific task (HTTP GET Method + task id)
    <img src="docs/GET_task.png" alt="Query of a specific task " title="Query of a specific task ">
-   Update a task (HTTP PATCH Method)
    <img src="docs/TOGGLE_task_isDone.png" alt="Update a task" title="Update a task">
-   Delete a task (HTTP DELETE Method)
    <img src="docs/DELETE_task.png" alt="Delete a task" title="Delete a task">
-   Query of all tasks after applying the PATCH and DELETE methods (HTTP DELETE, PATCH & GET methods)
    <img src="docs/GET_taskS_after_patch_and_delete.png" alt="Query of all registered tasks" title="Query of all registered tasks">
