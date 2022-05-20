# 課題6 -PHP1-環境構築、基礎文法-

## ①課題内容（どんな作品か）
- 一日の学習時間を知るためのアンケートを作成
- 入力すると、textファイルにデータが書き込まれ、そこから読み込みして集計結果を表示する仕組みを構築
- 集計結果を表とグラフで表示するようにした。

## ②工夫した点・こだわった点
- PHPのみでの円グラフ表示が難しく、JSにデータを受け渡しChart.jsを使って円グラフを表示させた。
- 表は降順で表示させるべく並び変えも実施した。

## ③質問・疑問（あれば）
- PHPでの円グラフ表示をグラフ作成ライブラリ「JpGraph」使用してやろうとしたがどうやってもできなかった。
- https://www.buildinsider.net/web/bookphplib100/024　に沿ってinclude_pathに含めてみたものの上手く機能しなかった。

## ④その他（感想、シェアしたいことなんでも）
- 役に立ったリンク
- 配列内の出現回数を返すarray_count_values関数　→　https://webkaru.net/php/array-count-values/
- PHPからJavaScriptへ配列を受け渡す方法　→　https://techacademy.jp/magazine/37729
- JSで円グラフ chart.js　→　https://uteee.com/system/3620/
