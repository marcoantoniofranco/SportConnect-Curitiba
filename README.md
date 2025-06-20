﻿# SportConnect Curitiba

 https://github.com/user-attachments/assets/7834f5c5-0bd3-4707-945f-d9502a7051c1

Sistema web para conectar atletas e organizar eventos esportivos em Curitiba.

## 📋 Sobre o Projeto

O SportConnect é uma plataforma que permite aos usuários:

- Criar eventos esportivos
- Encontrar parceiros para praticar esportes
- Participar de grupos esportivos
- Gerenciar categorias de esportes

## 🚀 Como Instalar

### Pré-requisitos

- XAMPP (Apache + MySQL + PHP)
- Navegador web

### Instalação

1. Clone ou baixe o projeto na pasta `htdocs` do XAMPP:

   ```
   C:\xampp\htdocs\SportConnect-Curitiba
   ```

2. Inicie o Apache e MySQL no XAMPP

3. Acesse o phpMyAdmin e importe o arquivo `banco.sql`

4. Acesse o sistema em:
   ```
   http://localhost/SportConnect-Curitiba/sportconnect
   ```

## 🔐 Conta de Teste

Para testar o sistema, use as seguintes credenciais:

**E-mail:** teste@gmail.com  
**Senha:** 123456

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8.0+
- **Frontend:** HTML5, CSS3
- **Framework:** Bootstrap 5.3
- **Banco de Dados:** MySQL
- **Ícones:** Bootstrap Icons

## ⚙️ Funcionalidades

### 🏠 Página Inicial

- Apresentação da plataforma
- Cards de esportes populares
- Seção "Como Funciona"

### 👤 Autenticação

- Cadastro de usuários
- Login/Logout
- Recuperação de senha
- Lembrar-me (cookies)

### 📅 Eventos Esportivos

- Criar eventos
- Listar eventos
- Participar de eventos
- Editar/Excluir eventos

### 🏆 Categorias

- Futebol, Basquete, Vôlei, Corrida
- Tênis, Natação, Ciclismo
- Gerenciamento de categorias

### 👥 Sistema de Participação

- Candidatar-se a eventos
- Aceitar/Recusar participantes
- Compartilhamento de contatos

### 🔒 Segurança

- Proteção CSRF
- Senhas hasheadas
- Validação de sessões
- Sanitização de dados

## 📁 Estrutura do Projeto

```
SportConnect-Curitiba/
├── banco.sql                 # Script do banco de dados
├── sportconnect/
│   ├── index.php            # Arquivo principal
│   ├── controllers/         # Controladores MVC
│   ├── models/             # Modelos de dados
│   ├── views/              # Páginas HTML
│   ├── includes/           # Arquivos de configuração
│   └── assets/             # CSS, imagens
└── README.md               # Este arquivo
```

## 🎯 Como Usar

1. **Acesse o sistema** usando as credenciais de teste
2. **Explore os eventos** na página "Eventos"
3. **Crie um novo evento** clicando em "Criar Evento"
4. **Participe de eventos** de outros usuários
5. **Gerencie categorias** no menu "Categorias"
6. **Edite seu perfil** no menu do usuário

## 📞 Contato

Para dúvidas ou sugestões sobre o projeto SportConnect Curitiba.

---

**Desenvolvido para conectar atletas em Curitiba! 🏃‍♂️⚽🏀🏐**
