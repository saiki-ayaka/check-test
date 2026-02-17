markdown
# check-test お問い合わせフォームの環境構築

## 1. セットアップ手順
    リポジトリのクローン
    ・git clone "リポジトリURL"
    ・cd checktest_contact-form
    コンテナの起動
    ・docker-compose up -d --build
    ライブラリのインストール
    ・docker-compose exec php composer install
    環境設定ファイル,アプリケーションキーの生成を行う。
    ・cp .env.example .env
    ・docker-compose exec php php artisan key:generate
    マイグレーションの実行を行う。データベースにテーブルを作成する。
    ・docker-compose exec php php artisan migrate
    初期データ(シーダー)の投入を行う。
    ・docker-compose exec php php artisan db:seed

## 2. 開発環境/アクセスURL
    ・お問い合わせ画面:　http://localhost
    ・ユーザー登録画面:　http://localhost/register
    ・phpMyAdmin:　http://localhost:8080

## 3. 使用技術(実行環境)
    ・Language: PHP 8.1.34
    ・Framework: Laravel 8.83.29
    #・JavaScript: jquery?(Laravel 8 のデフォルト（Laravel Mixなど）で入っていることが多いですが、使わなければ消してOK)
    ・Database: MYSQL 8.0.26
    ・WebServer: nginx 1.21.1
    ・tool: phpMyAdmin
    ・Container: Docker / Docker Compose

## 4. データベース設計図（ER図）
![ER図](./database-design.drawio.png)

## (?. テーブル一覧)
- **users**: 利用者情報
- **categories**: お問い合わせの種類　　（１番最初に作成した。）
- **contacts**: お問い合わせ詳細