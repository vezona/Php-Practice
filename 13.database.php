address_book


<!-- sid流水號，一般常用id，但要叫什麼都可以 -->
sid （數值）
name （字串）
email（字串）
mobile（字串，不要當數值，因為會有國際碼，而且數值的話前面的霖會被丟掉）
birthday
address
created_at

<!-- 何時建立、何時修改 -->
created_at
modified_at


編碼與排序 文字資料才要要
屬性 無所謂

primary 主要用識別別資料的欄位 (一張表要有一個)

Ａ.I自動編號，只有primary key才需要勾選

一班字串會用varchart，代表可以變動長度的字串，chart不能變數長度


**字串需要設定長度，，沒設定到時候會無法建立
varvhart習慣設定255
text可以設定到六萬多字


date 有固定長度，所以不用設定

空值是這個欄位是否允許是空的，如果打勾，預設值就會是空
空值不等於空字串哦！

索引建搜尋時快

general_ci的意思是搜尋時不區分大小寫！！