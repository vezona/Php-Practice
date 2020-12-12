INSERT INTO `address_book` 
(`sid`, `name`, `email`, `mobile`, `birthday`, `address`, `created_at`) 
VALUES 
('2', '李曉明2', '123@gmail.com', '0922381933', '2000-04-05', '台北市大安區', '2020-11-05 15:37:56')

-- ＳＱＬ裡面文字的值一定要單引號標，日期中間用-，時間用：
-- 結尾一定要有分號


UPDATE `address_book` SET `mobile` = '092238193' WHERE `address_book`.`sid` = 2;

-- 的where 類似於回圈的if，所以如果是 where 1，就代表 where true，跑一圈後所有的列表都是true，都要改