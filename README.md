# アプリケーション名
お問い合わせフォーム

## 環境構築
Dockerのビルド
1.git clone <https://github.com/konomin08/confirmation-test.git>
  cd <confirmation-test>
2.docker-compose build
3.docker-compose up -d

マイグレーションの実行
1.docker-compose exec app php artisan migrate

シーディングの実行
1.docker-compose exec app php artisan db:seed

## 使用技術(実行環境)
・PHP: 8.x
・Laravel: 8.x
・MySQL: 8.x
・Docker: 19.x 以上
・Docker Compose: 1.27.x 以上

## ER図
![ER図](./index.drawio.png)

## URL
・開発環境: http://localhost/