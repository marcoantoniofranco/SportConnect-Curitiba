CREATE DATABASE sportconnect;
USE sportconnect;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20) NOT NULL,
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

CREATE TABLE lembrar_tokens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    token VARCHAR(255) NOT NULL UNIQUE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    expira_em TIMESTAMP NOT NULL DEFAULT (CURRENT_TIMESTAMP + INTERVAL 30 DAY),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);

    INSERT INTO categorias_esportivas (nome, descricao) VALUES 
    ('Futebol', 'Jogos e treinos de futebol de campo e society'),
    ('Basquete', 'Partidas e treinos de basquete'),
    ('Vôlei', 'Jogos de vôlei de quadra e praia'),
    ('Corrida', 'Grupos de corrida e caminhada'),
    ('Tênis', 'Jogos e treinos de tênis'),
    ('Natação', 'Grupos de natação e hidroginástica'),
    ('Ciclismo', 'Pedais e grupos de ciclismo'),
    ('Esporte Geral', 'Outros esportes não especificados');

INSERT INTO usuarios (nome, email, telefone, cpf, data_nascimento, senha) VALUES 
('Usuário Teste', 'teste@gmail.com', '(41) 99999-9999', '123.456.789-00', '1990-01-01', '$2y$10$1NvJ72BcWSK4UVf7UeXgJOdE26QKwNYkDxNIppMPRjIMDl3ojyoIK');

