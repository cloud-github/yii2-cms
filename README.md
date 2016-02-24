Yii 2 CMS ( An alternative CMS for writesdown )
------------------------------------------------

Yii 2 CMS is a skeleton Yii 2 application with Role Based Access Authorization for making light CMS based applications.

The CMS includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

GETTING STARTED
---------------

After you install the application, you have to conduct the following steps to initialize
the installed application. You only need to do these once for all.

1. Run command `init` to initialize the application with a specific environment.
2. Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
3. Apply migrations with console command `yii migrate` for windows and for linux users `php yii migrate`. This will create tables needed for the application to work.
4. Set document roots of your Web server:

- for frontend using the URL `http://your_site/`
- for backend  using the URL `http://your_site/admin` username : admin and password : superadmin


SOME KEY ADDITIONS:

1. Elastic Search
