# E-NoticeBoard

About:
  This web application is designed to make student-staff life in institutes easier. The staff can post notifications which the students can access if they are connected to the application via intranet/internet. The main focus is given to the security. The administrator registration is only possible with access to the master-key which is to be obtained from the app-admin.
  
How to install:
1) Download the codes from git hub.
2) Copy it into your htdocs folder for Xammp Installation.
3) Create a database as follows:
  a) Database Name - enotice
  b) Table 1 - adminlogin - includes - admin_id, admin_name, admin_pass, master_key, admin_image.
  c) Table 2 - posts - includes - post_id, post_title, post_author, post_date, post_image, post_content, post_tags.
  d) Table 3 - shouts - includes - id, user, message, time.
  e) Table 4 - students - includes - id, roll_no, passcode, student_name.


