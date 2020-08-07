CREATE VIEW Vw_Services AS
SELECT s.*,u.name as UserName,cs.title as CategoryName,
CASE s.priority WHEN 1 THEN 'اول' WHEN 2 THEN 'دوم' WHEN 3 THEN 'سوم' WHEN 4 THEN 'چهارم' WHEN 5 THEN 'پنجم' WHEN 6 THEN 'ششم' END AS PersianPriority,
CASE s.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus
FROM services s
INNER JOIN category_services cs ON cs.id = s.categoryID_FK
INNER JOIN users u ON u.id = s.usersID_FK