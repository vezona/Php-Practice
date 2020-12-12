<?php

//傳統寫法
// isset是用來檢查有沒有給過age的值，如果有，就吐age的值，如果沒有，就給0
$age = isset($_GET['age']) ? $_GET['age'] : 0;
//＊注意，querystring這種事無論給什麼值，都會吐字串。所以如果要換成數值，要加intval
$age = isset($_GET['age']) ? intval($_GET['age']) : 0;


//php 7以後的isset寫法，省略isset 跟() :
//php ？？的意思是，如果有值，就丟出？前面的數值，如果沒有，就丟出？？後面的值
$age = $_GET['age'] ?? 0;

//去拿get參數（query string)那邊的age
//這個功能是要拿網址列參數，
echo $_GET['age'];


// isset()判斷變數有沒有設定
//intval()把字串換成數字
//floatval()則是把字串換成浮動點數
