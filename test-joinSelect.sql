SELECT*FROM `products` JOIN `categories`


合併查詢通常會這樣寫，重點是要下on
SELECT*FROM `products` JOIN `categories` on `products`.category_sid=`categories`.sid;


＊代表所有欄位

第一張表的所有欄位加上第二張表的所有欄位


SELECT * FROM `products` JOIN `categories` on `products`.category_sid = `categories`.sid; 

-- 代號簡寫
SELECT * FROM `products` as p JOIN `categories` as c on p.category_sid = c.sid; 


-- 代號簡寫的as 可以省略，用空格替代
SELECT * FROM `products` p JOIN `categories` c on p.category_sid = c.sid; 

-- 模糊搜尋，關鍵字是LIKE，用％代表全部字元
SELECT * FROM `products` WHERE `author` LIKE '％林％'

-- Where in，類似'購物車'會用到的功能 （購物車清單會抓出目前要的幾筆資料）
-- 加到最愛也是類似的功能，可以思考一下
SELECT * FROM `products` WHERE sid IN (10,6,24,1);


-- 加到最愛的資料表練習：加到最愛的資料表要有哪些欄位？
* 要先登入會員，才能加到最愛 members.id
* 要記錄會員是誰，所以要有“會員編號” product.id
* 再來是產品編號 (要搜尋時，就用join方式結合搜尋產品那張表的資料表)
* 最後是加入日期 created_at


-- CRUD: create(select), read, update, delete 
-- 其中 select最難
-- count數有幾個欄位
select count();

** 重要 join方式結合不同表單查詢
select c.name, count(1) num FROM `products` p 
JOIN categories c 
-- 設定條件，誰要跟誰對比
ON p.category_sid=c.sid
GROUP BY p.`category_sid`;

-- 折扣
SELECT *,`price`*0.8 FROM `products` WHERE 1

後面空格命名，就會幫你多生出一格special_price的欄位
SELECT *,`price`*0.8 special_price FROM `products` WHERE 1
