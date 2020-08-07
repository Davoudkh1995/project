CREATE VIEW Vw_Sliders AS
SELECT s.*,u.name AS UserName,
CASE s.status WHEN 0 THEN 'غیر قابل رویت' WHEN 1 THEN 'قابل رویت' END AS PersianStatus,
CASE s.priority WHEN 1 THEN 'اول' WHEN 2 THEN 'دوم' WHEN 3 THEN 'سوم' WHEN 4 THEN 'چهارم' WHEN 5 THEN 'پنجم' END AS PersianPriority,
CASE s.slider_type WHEN 1 THEN 'تصویری' WHEN 2 THEN 'متنی و تصویری' END AS PersianSliderType
FROM sliders s
INNER JOIN users u ON s.usersID_FK = u.id