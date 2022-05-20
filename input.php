<html>

<head>
    <meta charset="utf-8">
    <title>課題</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <form action="write.php" method="post">
        お名前: <input type="text" name="name">
        出身: <input type="text" name="birthPlace"><br>
        性別: <select  class ="sex" name="sex">
                <option value = "男性">男性</option>
                <option value = "女性">女性</option>
            </select>
        年齢: <select class = "age" name = "age">
                <option vlue = "20歳以下">20歳以下</option>
                <option vlue = "20歳～30歳">20歳～30歳</option>
                <option vlue = "30歳～40歳">30歳～40歳</option>
                <option vlue = "40歳～50歳">40歳～50歳</option>
                <option vlue = "50歳以上">50歳以上</option>
            </select>
        １週間の学習時間: <select class = "study_hours" name = "study_hours">
                <option vlue = "０～１時間">０～１時間</option>
                <option vlue = "１～３時間">１～３時間</option>
                <option vlue = "３～６時間">３～６時間</option>
                <option vlue = "６～１０時間">６～１０時間</option>
                <option vlue = "１０時間以上">１０時間以上</option>
            </select>
        <input class="button" type="submit" value="送信">
    </form>
</body>

</html>
