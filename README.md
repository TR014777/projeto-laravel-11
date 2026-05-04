# 📅 Agendan

O **Agendan** é um sistema feito pra quem quer parar de sofrer com agenda bagunçada e começar a ter controle de verdade sobre o próprio tempo.  
Se você trabalha com atendimentos — seja em salão, clínica, consultório ou como profissional autônomo — ele foi pensado pra simplificar sua rotina e deixar tudo mais organizado.

---

## 🚀 Sobre o projeto

O Agendan nasceu com um objetivo simples: **tirar o caos da organização de horários**.

Com ele, você consegue definir sua disponibilidade, visualizar sua agenda de forma clara e entender melhor como está a demanda do seu trabalho — tudo isso de forma prática e rápida.

Nada de planilhas confusas ou anotações perdidas.

---

## 🛠️ Tecnologias

Por trás de tudo isso, usamos ferramentas modernas e confiáveis:

- **Laravel** (v11.x)  
- **PHP** (v8.3+)  
- **Tailwind CSS**

---

## ✨ Funcionalidades

### 📊 Dashboard (Painel)
- Visão geral do seu dia
- Total de agendamentos, cancelamentos e tarefas concluídas
- Gráficos de demanda semanal
- Identificação de horários de pico

### 📅 Gestão de Agenda
- Calendário visual simples e intuitivo
- Criação e edição de agendamentos em poucos cliques
- Configuração de horários de trabalho (turnos)
- Visualização de quem será atendido em seguida

### 👥 Gestão de Usuários
- CRUD completo de usuários
- Filtros por nome, e-mail e status
- Controle de acesso e permissões

### 👤 Perfil do Usuário
- Atualização de dados pessoais
- Alteração de senha
- Gerenciamento de segurança da conta

---

## 💡 Benefícios

- **Menos dor de cabeça:** evite conflitos de horários  
- **Mais profissionalismo:** organização no atendimento  
- **Mais controle:** acompanhe sua rotina e demanda com clareza  

---

## 🛠️ Setup Do Projeto de Agendamento

### Passo a passo

Clone Repositório
```sh
git clone https://github.com/TR014777/projeto-laravel-11.git
```
```sh
cd projeto-laravel-11
```

Suba os containers do projeto
```sh
docker-compose up -d
```


Crie o Arquivo .env
```sh
cp .env.example .env
```

Mude o fuso horário para o seu dentro do arquivo .env
Ex.:
```
APP_TIMEZONE=America/Sao_Paulo
```

Acesse o container app
```sh
docker-compose exec app bash
```

Instale as dependências do projeto
```sh
composer install
```

Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Rodar as migrations
```sh
php artisan migrate
```

Acesse o projeto
[http://localhost:8000](http://localhost:8000)
