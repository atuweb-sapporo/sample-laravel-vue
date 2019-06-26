# Sample Laravel + Vue.js

## 使用言語、ライブラリなど

- PHP 7.4
- Laravel 5.5 
- Vue.js 2.x
- Firebase (Facebookログイン)


## アプリケーション機能

- レビュー表示 (無限スクロール)
- Facebookログイン
- 書籍検索
- レビュー投稿


## 主なディレクトリ構成

```
|- app
|   |- Http
|       |- Controllers   バックエンドコントローラー群
|       |- Models        Eloquent ORM
|       |- Repositories  Eloquent のラップクラス
|       |- Services      ビジネスロジッククラス
|
|- resourdes/
    |- assets
        |- js            フロントエンドコード
```



## 課題、今後の改修内容

- トップページにユーザ情報、書籍情報を表示する
- HogeStore を Vuex 化する
- ナビゲーションガードを利用して、レビュー投稿ページで認証チェックする
s