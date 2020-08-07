CREATE VIEW Vw_CategoryServices AS

SELECT cs.*,ccss.title AS ParentName,u.name AS UserName,
CASE cs.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus
FROM category_services cs
left JOIN category_services ccss ON ccss.id = cs.parent_id
INNER JOIN users u ON u.id = cs.usersID_FK