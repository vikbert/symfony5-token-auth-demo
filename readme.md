<div align="center">
  <img src="./docs/symfony.png" width="100" alt="symfony logo" />
  <h3>Symfony 5 Token Authentication</h3>
  <p>API token authentication demo with the new authentication system in symfony 5</p>

  <p>
    <a href="#">
      <img src="https://img.shields.io/badge/PRs-Welcome-brightgreen.svg?style=flat-square" alt="PRs Welcome">
    </a>
    <a href="#">
      <img src="https://img.shields.io/badge/License-MIT-brightgreen.svg?style=flat-square" alt="MIT License">
    </a>
  </p>
</div>

---

## Install
```bash
composer install 
```

## Init database
```bash
make db-init
```

## Development
```bash
symfony serve -d
```

## Test `/api/todos`
```bash
curl -i -X GET \
   -H "Authorization:Bearer e0468e55008e489fc54f6558f48afc13" \
 'https://127.0.0.1:8000/api/todos'
```

## Development from scratch
```bash
symfony new symfony5-token-auth-demo
cd symfony5-token-auth-demo

# install maker
symfony composer req maker
symfony composer req orm
# enable sqlite config in .env
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"//

# create todo entity
symfony console make:entity Todo

# load test todos into database
symfony composer req orm-fixtures --dev
symfony composer req zenstruck/foundry --dev
symfony console make:factory

# add the factory to fixtures
make db-update
# add TodoController to list todos
symfony console make:controller # TodoController
# add serializer pack to serialize the controller results
symfony composer req symfony/serializer-pack
# add subscriber to serialize the response to Json

# secure the API todos
symfony composer req security
symfony console make:user
symfony console make:entity User

make db-update

symfony console make:auth
# complete the implementation of ApiTokenAuthenticator
...
```

## licence

MIT [@vikbert](https://vikbert.github.io/)
