<?PHP
require_once("./include/fg_membersite.php");

$fgmembersite = new FGMembersite();

//Provide your site name here
$fgmembersite->SetWebsiteName('localhost/gwp/');

//Provide the email address where you want to get notifications
$fgmembersite->SetAdminEmail('Green.Power@gre.ac.uk');

//Provide your database login details here:
//hostname, user name, password, database name and table name
//note that the script will create the table (for example, fgusers in this case)
//by itself on submitting register.php for the first time
$fgmembersite->InitDB(/*hostname*/'localhost',
                      /*username*/'gwp-admin',
                      /*password*/'p',
                      /*database name*/'gwp',
                      /*table name user db*/'gwp_users',
					  /*table name log in attempts*/'gwp_LoginAttempts',
					  /*table name log in attempts*/'gwp_medway_campus_chp_data');

//For better security. Get a random string from this link: http://tinyurl.com/randstr
// and put it here
$fgmembersite->SetRandomKey('KSvtE4QcjQRdgaq');

//Set the encryption standard for the passwords, options: PASSWORD_BCRYPT or PASSWORD_DEFAULT
$fgmembersite->SetPasswordEncryption(PASSWORD_BCRYPT);

?>