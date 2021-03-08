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

## Development
```bash
symfony serve 
```

## Development from scratch
```bash
symfony new symfony5-token-auth-demo
cd symfony5-token-auth-demo

symfony composer req maker
symfony composer req security
symfony composer req orm

# enable sqlite config in .env
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"//
symfony console make:user

symfony composer req annotations 
symfony composer req twig
symfony console make:auth
symfony console debug:router

# load test user into database
symfony composer req orm-fixtures
symfony console make:migration
symfony console doctrine:mi:mi -n
symfony console make:fixtures 
symfony console doctrine:fixtures:load

symfony composer require --dev symfony/profiler-pack

symfony console make:controller # ProfileController
# protect the profile in controller
$this->denyAccessUnlessGranted('ROLE_USER');
# update the redirect URL in LoginFormAuthenticator
new RedirectResponse($this->urlGenerator->generate('app_profile'));

# complete the implementation in LoginFormAuthenticator
```

> more detailed info in `cli-protocol.md`


## licence

MIT [@vikbert](https://vikbert.github.io/)
