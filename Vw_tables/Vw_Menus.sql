CREATE VIEW Vw_Menus AS

SELECT m.*,mm.title AS ParentName,u.name AS UserName,
CASE m.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus
FROM menus m
left JOIN menus mm ON m.parent_id = mm.id
INNER JOIN users u ON m.usersID_FK = u.id