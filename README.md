markdown
# check-test お問い合わせフォームの環境構築

## 1. Dockerビルド
    開発環境を構築するために以下コマンドを使用し、ファイル内の記述を行う。
    ・cd check-test
    ・mkdir docker src
    ・touch docker-compose.yml
    ・cd docker
    ・mkdir mysql nginx php
    ・mkdir mysql/data
    ・touch mysql/my.cnf
    ・touch nginx/default.conf
    ・touch php/Dockerfile
    ・touch php/php.ini
    作成ファイルへの記述後、以下コマンドでビルドする。
    ・docker-compose up -d --build
## 2. laravel環境構築

    ・docker-compose exec php bash
    composerを使用してアプリケーションのベースファイルを作成する。(laravelはバージョン８を指定)
    ・composer create-project "laravel/laravel=8.*" . --prefer-dist
    以下コマンドで設定時間の確認を行い、日本時間に合わせる設定を行う。
    ・php artisan tinker
    　> echo Carbon\Carbon::now();
    ・
    ・
    ・

## 2.5. GitHubでリポジトリを作成する。
    checktest_contact-formの名前で作成。
    https://github.com というURLをコピーし、check-testディレクトリに移動後、以下のコマンドを実行する。
    ・git init
    ・git add .
    ・git commit -m "first commit"
    ・git branch -M main
    ・git push -u origin main

## 3. 開発環境

## 4. 使用技術(実行環境)

## 5. データベース設計図（ER図）
![ER図](./database-design.drawio.png)

## 2. テーブル一覧
- **users**: 利用者情報
- **categories**: お問い合わせの種類
- **contacts**: お問い合わせ詳細