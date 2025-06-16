USE sportconnect;

INSERT INTO categorias_esportivas (nome, descricao) VALUES
('Futebol', 'O esporte mais popular do Brasil'),
('Vôlei', 'Esporte de quadra em equipe'),
('Basquete', 'Esporte dinâmico e emocionante'),
('Tênis', 'Esporte individual ou em duplas'),
('Corrida', 'Exercício cardiovascular e competitivo'),
('Natação', 'Esporte aquático completo'),
('Ciclismo', 'Pedalada em grupo ou individual');

INSERT INTO usuarios (nome, email, telefone, cpf, data_nascimento, senha) VALUES
('João Silva', 'joao.silva@email.com', '(41) 99999-8888', '(41) 99999-8888', '123.456.789-01', '1995-03-15', '$2y$10$pO6sAhkoUhcBTsbtHKmheOxqPe7M246UtDD0Wi0ujI2ChvKOefBTq'),
('Maria Santos', 'maria.santos@email.com', '(41) 98888-7777', '(41) 98888-7777', '987.654.321-09', '1992-07-22', '$2y$10$pO6sAhkoUhcBTsbtHKmheOxqPe7M246UtDD0Wi0ujI2ChvKOefBTq'),
('Pedro Oliveira', 'pedro.oliveira@email.com', '(41) 97777-6666', NULL, '456.789.123-45', '1998-11-10', '$2y$10$pO6sAhkoUhcBTsbtHKmheOxqPe7M246UtDD0Wi0ujI2ChvKOefBTq'),
('Ana Costa', 'ana.costa@email.com', '(41) 96666-5555', '(41) 96666-5555', '789.123.456-78', '1990-05-30', '$2y$10$pO6sAhkoUhcBTsbtHKmheOxqPe7M246UtDD0Wi0ujI2ChvKOefBTq'),
('Usuário Teste', 'teste@exemplo.com', '(41) 99999-0000', '(41) 99999-0000', '000.000.000-01', '1990-01-01', '$2y$10$pO6sAhkoUhcBTsbtHKmheOxqPe7M246UtDD0Wi0ujI2ChvKOefBTq');

INSERT INTO publicacoes (id_usuario, id_categoria, titulo, descricao, local, data_evento, vagas) VALUES
(1, 1, 'Pelada no Parque Barigui', 'Futebol descontraído aos domingos pela manhã. Venha participar!', 'Parque Barigui - Campo 1', '2024-01-21 09:00:00', 20),
(2, 2, 'Vôlei na Praia - Pontal do Paraná', 'Vôlei de praia com galera animada. Todos os níveis são bem-vindos!', 'Pontal do Paraná - Praia Central', '2024-01-28 14:00:00', 12),
(3, 3, 'Basquete no Ginásio Municipal', 'Jogo de basquete 3x3. Traga sua camiseta!', 'Ginásio Municipal do Bairro Alto', '2024-01-25 19:00:00', 6),
(1, 5, 'Corrida Matinal no Parque Tingui', 'Corrida leve de 5km. Ideal para iniciantes e intermediários.', 'Parque Tingui - Portal de Entrada', '2024-01-23 06:30:00', 15),
(4, 1, 'Futebol Society - Sexta à Noite', 'Society no sintético. Divisão por nível de habilidade.', 'Arena Sports - Boa Vista', '2024-01-26 20:00:00', 14);

INSERT INTO participacoes (id_publicacao, id_usuario, status) VALUES
(1, 2, 'aceito'),
(1, 3, 'pendente'),
(1, 4, 'aceito'),
(2, 1, 'aceito'),
(2, 3, 'aceito'),
(3, 2, 'pendente'),
(4, 3, 'aceito'),
(5, 2, 'aceito'); 