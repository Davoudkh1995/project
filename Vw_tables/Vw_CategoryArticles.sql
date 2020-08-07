CREATE VIEW Vw_CategoryArticles AS

SELECT ca.*,ccaa.title AS ParentName,u.name AS UserName,
CASE ca.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus
FROM category_articles ca
left JOIN category_articles ccaa ON ccaa.id = ca.parent_id
INNER JOIN users u ON u.id = ca.usersID_FK