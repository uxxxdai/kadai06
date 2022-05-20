<?php
// ファイルを開く
$openFile = fopen("data/data.txt","r");
$bp_input = [];
$sex_input = [];
$age_input = [];
$hours_input = [];

// ファイル内容を1行ずつ読み込んで出力
while($str = fgets($openFile)){
    // echo nl2br($str);
    $ary = explode(",",$str);
    // var_dump($ary);
    array_push($bp_input,$ary[2]);
    array_push($sex_input,$ary[3]);
    array_push($age_input,$ary[4]);
    array_push($hours_input,$ary[5]);
    // var_dump($sex_input);
    // echo "<br>";
    $bp_output = array_count_values($bp_input);
    $sex_output = array_count_values($sex_input);
    $age_output = array_count_values($age_input);
    $hours_output = array_count_values($hours_input);

    $jbp_output = json_encode($bp_output);
    $jsex_output = json_encode($sex_output);
    $jage_output = json_encode($age_output);
    $jhours_output = json_encode($hours_output);

    // print_r($sex_output);
    // var_dump($hours_input);
    // echo "<br>";
    };

    // ファイルを閉じる
    fclose($openFile);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
<title>グラフ</title> 
<style type="text/css">

table {
width: 200px;
border: 2px #2b2b2b solid;
}
td {
border: 2px #2b2b2b solid;
text-align:center;
}

</style>

</head>
<body>
  <h1>アンケート結果集計</h1>
  <!-- ///////////////
  //所在地 HTML
  /////////////// -->
  <div class ="wrap" style="display:flex;width:600px;height:300px;align-content:center;">
  <table class="content-table" style="table-layout:fixed;width:100px;">
    <thead>
      <tr>
        <th style="width:100px;">カテゴリー</th>
        <th style="width:100px;">人数</th>
      </tr>
    </thead>
    <tbody id="playerList" style="text-align:center"></tbody>  <!-- ここに配列の中身を表示させる -->
  </table>
  <canvas id="myPieChart"></canvas>
  </div>
  <br><br><br>

  <!-- ///////////////
  //性別 HTML
  /////////////// -->
  <div class ="wrap" style="display:flex;width:600px;height:300px;align-content:center;">
  <table class="content-table" style="table-layout:fixed;width:100px;">
    <thead>
      <tr>
        <th style="width:100px;">カテゴリー</th>
        <th style="width:100px;">人数</th>
      </tr>
    </thead>
    <tbody id="playerList2" style="text-align:center"></tbody>  <!-- ここに配列の中身を表示させる -->
  </table>

  <canvas id="myPieChart2"></canvas>
  </div>
  <br><br><br>

  <!-- ///////////////
  //年齢 HTML
  /////////////// -->  
  <div class ="wrap" style="display:flex;width:600px;height:300px;align-content:center;">
  <table class="content-table" style="table-layout:fixed;width:100px;">
    <thead>
      <tr>
        <th style="width:100px;">カテゴリー</th>
        <th style="width:100px;">人数</th>
      </tr>
    </thead>
    <tbody id="playerList3" style="text-align:center"></tbody>  <!-- ここに配列の中身を表示させる -->
  </table>

  <canvas id="myPieChart3"></canvas>
  </div>
  <br><br><br>

  <!-- ///////////////
  //学習時間 HTML
  /////////////// -->  
  <div class ="wrap" style="display:flex;width:600px;height:300px;align-content:center;">
  <table class="content-table" style="table-layout:fixed;width:100px;">
    <thead>
      <tr>
        <th style="width:100px;">カテゴリー</th>
        <th style="width:100px;">人数</th>
      </tr>
    </thead>
    <tbody id="playerList4" style="text-align:center"></tbody>  <!-- ここに配列の中身を表示させる -->
  </table>

  <canvas id="myPieChart4"></canvas>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>

  <script>
  //PHPからJSにデータ受け渡し
  var bp_output = <?php echo $jbp_output; ?>;
  var sex_output = <?php echo $jsex_output; ?>;
  var age_output = <?php echo $jage_output; ?>;
  var hours_output = <?php echo $jhours_output; ?>;

  //各々配列内で人数の並び順を降順に
  var array = Object.keys(bp_output).map((k)=>({ key: k, value: bp_output[k] }));
  array.sort((a, b) => b.value - a.value);
  bp_output = Object.assign({}, ...array.map((item) => ({
      [item.key]: item.value,
  })));

  var array = Object.keys(sex_output).map((k)=>({ key: k, value: sex_output[k] }));
  array.sort((a, b) => b.value - a.value);
  sex_output = Object.assign({}, ...array.map((item) => ({
      [item.key]: item.value,
  })));

  var array = Object.keys(age_output).map((k)=>({ key: k, value: age_output[k] }));
  array.sort((a, b) => b.value - a.value);
  age_output = Object.assign({}, ...array.map((item) => ({
      [item.key]: item.value,
  })));

  var array = Object.keys(hours_output).map((k)=>({ key: k, value: hours_output[k] }));
  array.sort((a, b) => b.value - a.value);
  hours_output = Object.assign({}, ...array.map((item) => ({
      [item.key]: item.value,
  })));

  ///////////////
  //出身地 テーブル作成
  ///////////////
  var playerList = document.getElementById("playerList");
  // console.log(Object.keys(bp_output));
  console.log(sex_output);

  Object.keys(bp_output).forEach(function(key) {// 配列の中のオブジェクトの数だけ処理を繰り返す
    var val = this[key];
    var tr = document.createElement('tr');  
    playerList.appendChild(tr); // 表の中に配列の要素数の「tr」（行）ができる

    var td = document.createElement('td');
    td.textContent = key; 
    tr.appendChild(td);
    var td = document.createElement('td');
    td.textContent = val; 
    tr.appendChild(td);
    },bp_output);

  /////////////////
  //出身地 円グラフ作成
  ///////////////
  var ctx = document.getElementById("myPieChart");
  var label_bp = Object.keys(bp_output);
  var data_bp = Object.values(bp_output);

  var myPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: label_bp,
      datasets: [{
          backgroundColor: [
              "#BB5179",
              "#FAFF67",
              "#58A27C",
              "#3C00FF",
              "#F4A460",
              "#F5DEB3",
              "#9ACD32",
              "#AFEEEE",
              "#0000CD",
              "#FFFFE0",
              "#ADFF2F",
              "#228B22",
              "#FFD700",
              "#8B008B",
              "#00FFFF",
          ],
          data: data_bp,
      }]
    },
    options: {
      title: {
        display: true,
        text: '出身地分布表'
      }
    }
  });

  ///////////////
  //性別 テーブル作成
  ///////////////
  var playerList2 = document.getElementById("playerList2");

  Object.keys(sex_output).forEach(function(key) {// 配列の中のオブジェクトの数だけ処理を繰り返す
    var val = this[key];
    console.log(key,val);
    var tr = document.createElement('tr');  
    playerList2.appendChild(tr); // 表の中に配列の要素数の「tr」（行）ができる

    var td = document.createElement('td');
    td.textContent = key; 
    tr.appendChild(td);
    var td = document.createElement('td');
    td.textContent = val; 
    tr.appendChild(td);
    },sex_output);

  /////////////////
  //性別 円グラフ作成
  ///////////////
  var ctx = document.getElementById("myPieChart2");
  var label_sex = Object.keys(sex_output);
  var data_sex = Object.values(sex_output);

  var myPieChart2 = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: label_sex,
      datasets: [{
          backgroundColor: [
              "#BB5179",
              "#FAFF67",
              "#58A27C",
              "#3C00FF",
              "#F4A460",
              "#F5DEB3",
              "#9ACD32",
              "#AFEEEE",
              "#0000CD",
              "#FFFFE0",
              "#ADFF2F",
              "#228B22",
              "#FFD700",
              "#8B008B",
              "#00FFFF",
          ],
          data: data_sex,
      }]
    },
    options: {
      title: {
        display: true,
        text: '性別分布表'
      }
    }
  });

  ///////////////
  //年齢 テーブル作成
  ///////////////
  var playerList3 = document.getElementById("playerList3");

  Object.keys(age_output).forEach(function(key) {// 配列の中のオブジェクトの数だけ処理を繰り返す
    var val = this[key];
    var tr = document.createElement('tr');  
    playerList3.appendChild(tr); // 表の中に配列の要素数の「tr」（行）ができる

    var td = document.createElement('td');
    td.textContent = key; 
    tr.appendChild(td);
    var td = document.createElement('td');
    td.textContent = val; 
    tr.appendChild(td);
    },age_output);

  /////////////////
  //年齢 円グラフ作成
  ///////////////
  var ctx = document.getElementById("myPieChart3");
  var label_age = Object.keys(age_output);
  var data_age = Object.values(age_output);

  var myPieChart3 = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: label_age,
      datasets: [{
          backgroundColor: [
              "#BB5179",
              "#FAFF67",
              "#58A27C",
              "#3C00FF",
              "#F4A460",
              "#F5DEB3",
              "#9ACD32",
              "#AFEEEE",
              "#0000CD",
              "#FFFFE0",
              "#ADFF2F",
              "#228B22",
              "#FFD700",
              "#8B008B",
              "#00FFFF",
          ],
          data: data_age,
      }]
    },
    options: {
      title: {
        display: true,
        text: '年齢分布表'
      }
    }
  });

  ///////////////
  //学習時間 テーブル作成
  ///////////////
  var playerList4 = document.getElementById("playerList4");

  Object.keys(hours_output).forEach(function(key) {// 配列の中のオブジェクトの数だけ処理を繰り返す
    var val = this[key]; // 第二因数にhours_outputを入れるとthisにそれが入る
    var tr = document.createElement('tr');  
    playerList4.appendChild(tr); // 表の中に配列の要素数の「tr」（行）ができる

    var td = document.createElement('td');
    td.textContent = key; 
    tr.appendChild(td);
    var td = document.createElement('td');
    td.textContent = val; 
    tr.appendChild(td);
    },hours_output);

  /////////////////
  //学習時間 円グラフ作成
  ///////////////
  var ctx = document.getElementById("myPieChart4");
//   console.log(Object.keys(bp_output).length);
//   console.log(Object.keys(bp_output));
//   console.log(Object.values(bp_output));
  var label_hours = Object.keys(hours_output);
  var data_hours = Object.values(hours_output);

  var myPieChart4 = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: label_hours,
      datasets: [{
          backgroundColor: [
              "#BB5179",
              "#FAFF67",
              "#58A27C",
              "#3C00FF",
              "#F4A460",
              "#F5DEB3",
              "#9ACD32",
              "#AFEEEE",
              "#0000CD",
              "#FFFFE0",
              "#ADFF2F",
              "#228B22",
              "#FFD700",
              "#8B008B",
              "#00FFFF",
          ],
          data: data_hours,
      }]
    },
    options: {
      title: {
        display: true,
        text: '学習時間分布表'
      }
    }
  });
  </script>
</body>
</html>