# ec2_operate

## Requirement
このアプリはDockerにて動作します。以下のインストールが必要です。
* [docker](https://docs.docker.com/install/)
* [docker-compose](https://docs.docker.com/compose/)

## Installation
以下の手順に従いアプリケーションを起動してください。
* .envに必要項目を設定してください。

```bash
$ cp .env.default .env

# 環境変数を編集
$ vi .env
 
# コンテナイメージの作成
$ docker-compose build

# コンテナ起動
$ docker-compose up
```

設定したURLにアクセスしてください。(localで起動している場合は以下URLです)

http://localhost:18077

