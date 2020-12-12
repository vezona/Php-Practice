<?php

// 加這個的話是告訴程式我送的資料的格式，否則一率視為字串
header("Content-Type:Application/json");

// 看一下上傳的這個檔案的資料
echo json_encode($_FILES);


// *** 這邊用postman程式測試上傳 ******

// 1. 選ＰＯＳＴ，輸入這個頁面的網址
// 2. 在body 選擇 form-data
// 3. key選擇file
// 4. 輸入輸入key的名稱 ex:picture （如果想要上傳多張圖/多個檔，就要在名稱後面加陣列符號 ex: picture[]）
// 5. 在那欄選擇想要的圖片
// 6. 送出
// 7. 就可以看到下方傳送的值了


// 下方傳送的值 ---- 一張圖
// "avatar": {
//     "name": "me.jpg",
//     "type": "image/jpeg",
//     "tmp_name": "/Applications/MAMP/tmp/php/phpM9cBFV", 這列的意思是，檔案上傳後都會被存到暫存檔，這樣是系統為了避免有些檔案是惡意的執行檔等等。如果你需要這個檔案，就要把它移到其他地方，否則這支php執行完或關閉後，系統就會清掉暫存檔
//     "error": 0,
//     "size": 78023
// }

// 下方傳送的值 ---- 多張圖
// "avatar": {
//     "name": [
//         "me.jpg",    --第一張圖
//         "us.jpg"     --第二張圖
//     ],
//     "type": [
//         "image/jpeg",
//         "image/jpeg"
//     ],
//     "tmp_name": [
//         "/Applications/MAMP/tmp/php/phpkDo3aQ",
//         "/Applications/MAMP/tmp/php/phpk9Hju9"
//     ],
//     "error": [
//         0,
//         0
//     ],
//     "size": [
//         78023,
//         428909
//     ]
// }