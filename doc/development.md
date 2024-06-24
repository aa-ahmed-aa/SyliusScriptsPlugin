## Development

### Start docker
1. Execute `cd ./.docker && ./bin/start_dev.sh`
2. Configure `/etc/hosts` adding the line `127.0.0.1    syliusplugin.local`


### Fixtures

Fixtures are configured in `src/Resources/config/bundle/fixtures.yaml`.  
Each time you start docker compose, fixtures are automatically executed (see `docker-compose.yaml`).  

<br/>

<ul>
<li><a href="doc/installation.md">Installation</a></li>
<li><a href="doc/development.md">Development</a></li>
<li><a href="doc/testing.md">Testing</a></li>
</ul>