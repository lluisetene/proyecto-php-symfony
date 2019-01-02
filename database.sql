CREATE DATABASE IF NOT EXISTS symfony_master;
USE symfony_master;

CREATE TABLE IF NOT EXISTS users (
  id        int(255) auto_increment not null,
  role      varchar(255),
  name      varchar(255),
  surname   varchar(255),
  email     varchar(255),
  password  varchar(255),
  create_at DATETIME,
  CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Lluís', 'NE', 'lluis@lluis.com', 'lluis', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Núria', 'NE', 'nuria@nuria.com', 'lluis', CURTIME());
INSERT INTO users VALUES(NULL, 'ROLE_USER', 'Trufa', 'NE', 'trufa@trufa.com', 'lluis', CURTIME());

CREATE TABLE IF NOT EXISTS tasks (
  id        int(255) auto_increment not null,
  user_id   int(255) not null,
  title     varchar(255),
  content   text,
  priority  varchar(255),
  hours     int(255),
  create_at DATETIME,
  CONSTRAINT pk_tasks PRIMARY KEY(id),
  CONSTRAINT fk_task_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO tasks VALUES(NULL, 1, 'Tarea 1', 'Contenido de prueba 1', 'high', 40, CURTIME());
INSERT INTO tasks VALUES(NULL, 2, 'Tarea 2', 'Contenido de prueba 2', 'medium', 50, CURTIME());
INSERT INTO tasks VALUES(NULL, 3, 'Tarea 3', 'Contenido de prueba 3', 'low', 10, CURTIME());
