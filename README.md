# PHP掲示板アプリ

このプロジェクトは、PHPとMySQLを使用して作成したシンプルな掲示板アプリケーションです。ユーザーは名前とコメントを投稿でき、投稿内容はデータベースに保存され、ページに表示されます。

## 使用技術
- **PHP**: サーバーサイドのロジック
- **MySQL**: コメントデータを保存するためのデータベース
- **HTML/CSS**: フロントエンドの表示

## 機能
- ユーザーが名前とコメントを入力して投稿
- データベースにコメントを保存
- 投稿されたコメントを掲示板に表示

## セットアップ方法
1. **サーバー環境の準備**  
   XAMPPなどのPHPサーバーをインストールし、MySQLデータベースをセットアップします。

2. **データベースの作成**  
   データベース名を `bulletin_board` に設定し、次のSQLクエリでテーブルを作成します:

   ```sql
   CREATE TABLE `bb-table` (
     `id` INT AUTO_INCREMENT PRIMARY KEY,
     `userName` VARCHAR(30) NOT NULL,
     `comment` TEXT NOT NULL,
     `postDate` DATETIME NOT NULL
   );
