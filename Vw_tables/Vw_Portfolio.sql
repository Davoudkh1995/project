CREATE VIEW Vw_Portfolio AS
SELECT p.*,u.name as UserName,cp.title as CategoryName,
CASE p.priority WHEN 1 THEN 'اول' WHEN 2 THEN 'دوم' WHEN 3 THEN 'سوم' WHEN 4 THEN 'چهارم' WHEN 5 THEN 'پنجم' WHEN 6 THEN 'ششم' END AS PersianPriority,
CASE p.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus
FROM portfolios p
INNER JOIN category_portfolios cp ON cp.id = p.categoryID_FK
INNER JOIN users u ON u.id = p.usersID_FK
