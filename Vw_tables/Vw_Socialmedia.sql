CREATE VIEW Vw_Socialmedia AS
SELECT sm.*,
CASE sm.type WHEN 1 THEN 'اینستاگرام' WHEN 2 THEN 'لینکدین' WHEN 3 THEN 'توییتر' WHEN 4 THEN 'تلگرام' WHEN 5 THEN 'یوتیوب' WHEN 6 THEN 'گپ' WHEN 7 THEN 'سروش' WHEN 8 THEN 'آپارات' END AS PersianTitle,
CASE sm.status WHEN 1 THEN 'قعال' WHEN 0 THEN 'غیر قعال' END AS PersianStatus
from socialmedia sm