# zoom
ZOOM API FOR LARAVEL PROJECTS

## REQUIREMENTS
- laravel min 5.7
- PHP version 7.2
- table with name **ZoomCredentials

## tables zoom_credentials
CREATE TABLE `zoom_credentials` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `req_type` varchar(200) DEFAULT NULL,
  `end_point` varchar(200) DEFAULT NULL,
  `grant_type` varchar(100) DEFAULT NULL COMMENT 'refresh_token, authorization_code, access_token',
  `client_id` varchar(100) DEFAULT NULL,
  `client_secret` varchar(100) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL COMMENT 'The authorization code supplied to the callback by Zoom. ketika aplikasi di install',
  `redirect_uri` varchar(100) DEFAULT 'https://sipp.p3sm.or.id/' COMMENT 'default base_url',
  `authorization` varchar(100) DEFAULT NULL COMMENT 'basic Client_ID:Client_Secret, Bearer',
  `token` text,
  `refresh_token` text,
  `expires_in` bigint(20) DEFAULT NULL,
  `scope` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `zoom_credentials` */

insert  into `zoom_credentials`(`id`,`req_type`,`end_point`,`grant_type`,`client_id`,`client_secret`,`code`,`redirect_uri`,`authorization`,`token`,`refresh_token`,`expires_in`,`scope`,`created_at`,`updated_at`) values 
(1,NULL,'https://zoom.us/oauth/token','authorization_code','','',NULL,'','basic',NULL,NULL,NULL,NULL,NULL,NULL),
(2,NULL,NULL,'access_token','','',NULL,'','Bearer ','','',3599,'','2021-01-09 12:35:11','2021-01-09 12:35:11'),
(3,NULL,NULL,'refresh_token','','',NULL,'','basic','','',3599,'','2021-01-08 20:53:03','2021-01-09 12:35:11');


## INSTALLATION
- create model with name ZoomCredentials : we will store all credentials from OAUTH ZOOM API here
- fill all field in table zoom_credentials, note: refresh token only for **refresh_token** no matter its redudant
- set environtment
ZOOM_ENDPOINT=https://api.zoom.us/v2/
ZOOM_USERID={YOUT_ZOOM_USER_ID}

## HOW TO USE
- import library
use Gandhist\Zoom\Meetings;
- create new instance
$my_account = new Meetings::getAccount();
- response as default will return zoom api response also 
{
  'url' : 'api.yourhit.com'
  'http_code' : 200,
  'primary_ip' : '127.0.0.1',
  'local_ip' : '127.0.0.1',
}
  
## current function
all method needs url end point and body from zoom api, reference :  **[ZOOM Docs](https://marketplace.zoom.us/docs/api-reference/zoom-api)**
- list : list meeting
- createMeeting
- updateMeeting
- deleteMeeting
- addRegistrant
- getAccount
- refreshToken
- requestToken

## NOTE
- EVERY HIT TOKEN WILL REFRESH
- THIS IS EXPERIMENTAL
