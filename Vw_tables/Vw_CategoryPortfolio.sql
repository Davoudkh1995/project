CREATE VIEW Vw_CategoryPortfolio AS
SELECT cp.*,ccpp.title AS ParentName,u.name AS UserName,
CASE cp.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus
FROM category_portfolios cp
left JOIN category_portfolios ccpp ON ccpp.id = cp.parent_id
INNER JOIN users u ON u.id = cp.usersID_FK
