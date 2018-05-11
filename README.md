# sample-app-loanco-jp-php-laravel

Laradocを使ったDockerとLaravel環境で動作します。  
現時点では、個人ローンのみ動作します。

```
$ git clone 
$ git submodule add https://github.com/Laradock/laradock.git
$ cd laradock
$ cp env-example .env
```

nginxなどのポートは適切に変更して下さい

workspaceコンテナを起動し、インストールします。
```
$ docker-compose up -d workspace 
$ docker-compose exec workspace bash 
/var/www# composer create-project --prefer-dist laravel/laravel ./ 
```

DocuSign SDKをインストール
```/var/www# composer require docusign/esign-client  ```

DocuSign SDK for PHPがJWT認証サポートしていないので、HTTPクライアントを導入
```/var/www# composer require guzzlehttp/guzzle ``` 

Firebase/php-jwtをインストール
```/var/www# composer require firebase/php-jwt  ```

起動
```$ docker-compose up -d php-fpm nginx```

