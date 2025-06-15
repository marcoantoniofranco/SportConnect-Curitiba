CREATE DATABASE sportconnect;
USE sportconnect;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20) NOT NULL,
    whatsapp VARCHAR(20),
    cpf VARCHAR(14) NOT NULL UNIQUE,
    data_nascimento DATE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE categorias_esportivas (
    id_categoria INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT
);

CREATE TABLE publicacoes (
    id_publicacao INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_categoria INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT NOT NULL,
    local VARCHAR(255) NOT NULL,
    data_evento DATETIME NOT NULL,
    vagas INT NOT NULL,
    
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias_esportivas(id_categoria) ON DELETE CASCADE
);

CREATE TABLE participacoes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_publicacao INT NOT NULL,
    id_usuario INT NOT NULL,
    status VARCHAR(20) DEFAULT 'pendente',
    
    FOREIGN KEY (id_publicacao) REFERENCES publicacoes(id_publicacao) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    
    UNIQUE KEY unique_participacao (id_publicacao, id_usuario)
);

