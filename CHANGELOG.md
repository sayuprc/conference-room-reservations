# Change Log

アプリケーションの更新履歴。

## [1.3.1](https://github.com/sayuprc/conference-room-reservations/releases/tag/v1.3.1) - 2022-08-03

### Changed

- 各UseCaseが返すResponseクラスで利用する型をエンティティからモデルに変更。
- テストの実行順に依存しないFeatureテスト環境の構築。

### Fix

- 予約登録画面の登録ボタンの文言が「更新」になっていたのを修正。

## [1.3.0](https://github.com/sayuprc/conference-room-reservations/releases/tag/v1.3.0) - 2022-07-30

### Added

- ダークモードの追加。

### Changed

- ライトモードの調整。
- FormRequestからexistsルールを除外。ドメインサービスで存在チェックをするように変更。
- モック用ソースコードの挙動を調整。

### Fix

- リクエストのエラー文言に、一部英語の項目名が出ていたバグの修正。

## [1.2.0](https://github.com/sayuprc/conference-room-reservations/releases/tag/v1.2.0) - 2022-07-24

### Added

- 予約の削除機能を追加。

### Changed

- リポジトリの集約を変更。また、変更に伴いリファクタリングの実施。

### Fix

- 予約更新ボタンの文言を「登録」から「更新」に修正。

## [1.1.0](https://github.com/sayuprc/conference-room-reservations/releases/tag/v1.1.0) - 2022-07-18

### Added

- 予約の登録可能条件を追加。
- 予約の詳細表示および更新機能を追加。
- 会議室および予約の各詳細画面に、前の画面に戻るリンクを追加。

### Changed

- 一覧画面で表示される予約は終了日時が到来していないデータのみを表示するように変更。
- 予約の表示を日付ごとにグループ化して表示。
- 予約の表示順を開始日時の昇順に変更。
- 予約登録時の備考の入力欄をtextareaに変更。

### Fix

- 会議室IDが存在しないものを指定したとき、アプリケーションが停止してしまうバグの修正。

## [1.0.0](https://github.com/sayuprc/conference-room-reservations/releases/tag/v1.0.0) - 2022-07-13

会議室予約アプリのリリース