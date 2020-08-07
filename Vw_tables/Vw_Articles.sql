CREATE VIEW Vw_Articles AS
SELECT a.*,u.name as UserName,ca.title as CategoryName,
CASE a.priority WHEN 1 THEN 'اول' WHEN 2 THEN 'دوم' WHEN 3 THEN 'سوم' END AS PersianPriority,
CASE a.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus,
CASE a.popular WHEN 0 THEN 'نامعروف' WHEN 1 THEN 'معروف' END AS PersianPopular
FROM articles a
INNER JOIN category_articles ca ON ca.id = a.categoryID_FK
INNER JOIN users u ON u.id = a.usersID_FK
