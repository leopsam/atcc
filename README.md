# atcc

Projeto de TCC originalmente desenvolvido em 2016 e agora reescrito com ferramentas modernas.

## Instalação

1. **Dependências**

   ```bash
   npm install
   ```

2. **Variáveis de ambiente**

   Copie `.env.example` para `.env` e defina as chaves necessárias:

   ```bash
   DATABASE_URL=postgresql://usuario:senha@localhost:5432/atcc
   NEXTAUTH_URL=http://localhost:3000
   NEXTAUTH_SECRET=chave

   CLOUD_NAME=seu-cloud
   API_KEY=sua-chave
   API_SECRET=seu-segredo
   API_CLOUDINARY_URL=url-opcional
   ```

   O projeto utiliza PostgreSQL; `DATABASE_URL` deve apontar para a instância do banco.

3. **Migrações Prisma**

   Execute as migrações e, opcionalmente, o seed de dados:

   ```bash
   npx prisma migrate dev
   npx prisma db seed    # opcional
   ```

## Execução

Para iniciar o ambiente de desenvolvimento:

```bash
npm run dev
```

Para build e execução em produção:

```bash
npm run build
npm start
```

## Arquitetura

- **Next.js** com App Router em `src/app` para páginas, componentes e rotas de API.
- **Prisma** gerencia o acesso ao banco e migrations (pasta `prisma/`).
- **NextAuth** cuida da autenticação, configurado em `src/app/api/auth/[...nextauth]/route.js`.
- **Controllers** (`src/app/controllers/`) tratam as requisições e delegam aos
  **services** (`src/app/services/`), que concentram a lógica de negócio e integração com o banco.

