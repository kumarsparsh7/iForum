**Abstract:**

In this project, we’re developing a website from scratch using technologies such
as HTML and CSS as front-end, PHP as back-end, MySQL database platform for
creation of database and phpMyAdmin to integrate the website with database.

We’re demonstrating various cyber-attacks possible based on vulnerabilities
found in the source code of website which we will be scanning using Kali Linux
based tool Vega Vulnerability Scanner.

We would be executing following attacks:

-   **SQL Injection** attack on Login page,

-   **Session Fixation** attack on URL addressed to Login page,

-   **Cross-site Scripting (XSS)** attack,

-   **Cross-site Request Forgery** attack,

    followed by tweaking the source code to best solution possible within our
    scope in order to showcase the prevention of all the mentioned attacks.

    **Technical Specifications:**

    **Languages used** –

-   HTML

-   CSS

-   PHP

-   SQL

    **Tools used** –

-   Operating System

    -   Windows 10

-   Visual Studio Code

-   XAMPP Web Server

-   phpMyAdmin (for SQL Database)

-   Vega Vulnerability Scanner

**Browsers** –

-   Microsoft Edge

**Module Description:**

**Dashboard**

This module deals with the landing page of our forum website. It provides the
user with access to threads of multiple categories (e.g., Python, Java)
alongside with search bar at the top. Login module and Signup module are also
included in this page.

**Login**

This module is responsible for authentication of users who have registered on
the website. Only the users who have logged in have access to the various
functionalities of the forum, as in, posting comments or starting discussions
(discussed in further modules). This module will be used for exploitation
through **SQL Injection**, **Cross-Site Request Forgery (CSRF)** and **Session
Fixation** attacks.

**SignUp**

This module allows users to register themselves in user’s database of the
website and escalate their privilege to add data into database in form of new
threads or comments to existing threads.

**Thread Categories**

This module lists out all the categories of discussions registered in database.
This can only be modified through backend of the website. Users can view all the
categories of threads at once in the **Dashboard** module. It includes
categories like Java, Python, etc.

**Discussions**

This module allows logged-in users to start a discussion, i.e., create a new
thread as well as to view existing discussions with their titles and
descriptions. Non-logged in users can only view the existing discussions. This
module connects to **Comments** module.

**Comments**

This module allows users to view comments posted under a discussion for every
user and to post comment for logged-in users. This module will be used for
exploitation through **Cross-Site Scripting (XSS)** attack.

**  
**

**![](media/c43530228966a70621472c4529c2538d.png)Environment Output (Website
Screenshots):**

![](media/7362bcfd4e84660f961be562cf08b8c2.png)

**Figure 2 : SignUp Page**

![](media/7e3ca1deba5e910c35f53e95db3fbe10.png)

**Figure 3 : Login Page**

**![](media/56d9af04002c485f0034c5f91bd7a6c3.jpeg)**

**Figure 4 : Thread - Start a Discussion (Non-logged-in users)**

![](media/380bac23edb06adf9ff0e27b48bb976a.jpeg)

**Figure 5 : Thread - Post a Comment (Non-logged-in users)**

**  
**

**![](media/76a30e14fc514f9297d6d2f8df1883b4.jpeg)**

**Figure 6 : Thread - Start a Discussion (Logged-in users)**

**![](media/c21458608e0fd088748672eb269d7728.jpeg)**

**Figure 7 : Thread - Post a Comment (Logged-in users)**

**  
**

**![](media/5f587f0d7b3ffe18873d405e7b893ccf.jpeg)**

**Figure 8 : Database - "Users" table**

**![](media/1529c6087563b9fb703707bf4fead879.png)**

**Figure 9 : Database - "Categories" table**

**![](media/d96d184622e37f03e9d27562fe6fce15.png)**

**Figure 10 : Database - "Threads" table**

**![](media/09d07c33f98886bcc3bec556aa974979.png)**

**Figure 11 : Database - "Comments" table**

**Attack Procedure:**

**SQL Injection**

SQL injection is a type of injection attack. Injection attacks occur when
maliciously crafted inputs are submitted by an attacker, causing an application
to perform an unintended action. Because of the ubiquity of SQL databases, SQL
injection is one of the most common types of attack on the internet.

**Severity of SQL Injection –**

-   Extract sensitive information, like Social Security numbers, or credit card
    details.

-   Enumerate the authentication details of users registered on a website, so
    these logins can be used in attacks on other sites.

-   Delete data or drop tables, corrupting the database, and making the website
    unusable.

-   Inject further malicious code to be executed when users visit the site.

**Procedure –**

SQL Injection using WHERE clause - Placing an unwanted part of the code in the
WHERE part of the query is the most common way how SQL injection is being done.
Since we are exploiting “**Login**” form in our environment, we’ll be injecting
SQL command in the either of the fields in that module –

![](media/874cbf149a9310b80a84f41ab45b70ea.png)

We’ll be passing the following value in **Password** field –

*Password*: **‘ or ‘1 ‘=’1**

Resultant SQL Statement will be –

**SELECT \* FROM \`users\` WHERE user_email = '\$email' and user_pass = '’ or ‘1
‘=’1'**

So, we have the value related to the desired row, but we’ve added OR 1 = 1. This
condition always holds and therefore for each row in this table the whole
condition shall be true and we’ll return all rows from the table.

**  
**

**Cross-Site Scripting (XSS)**

Cross-site scripting (XSS) is one of the most common methods hackers use to
attack websites. XSS vulnerabilities permit a malicious user to execute
arbitrary chunks of JavaScript when other users visit your site. XSS allows
arbitrary execution of JavaScript code, so the damage that can be done by an
attacker depends on the sensitivity of the data being handled by your site.

**Severity of XSS –**

-   Spreading worms on social media sites. Facebook, Twitter and YouTube have
    all been successfully attacked in this way.

-   Session hijacking. Malicious JavaScript may be able to send the session ID
    to a remote site under the hacker’s control, allowing the hacker to
    impersonate that user by hijacking a session in progress.

-   Identity theft. If the user enters confidential information such as credit
    card numbers into a compromised website, these details can be stolen using
    malicious JavaScript.

-   Denial of service attacks and website vandalism.

-   Theft of sensitive data, like passwords.

-   Financial fraud on banking sites.

**Procedure –**

This attack occurs when the malicious user finds the vulnerable parts of the
website and sends it as appropriate malicious input. Malicious script is being
injected into the code and then sent as the output to the final user. We’ll be
injecting script as a comment in “**Comment**” module –

![](media/bf93f0a5afd3993ed99258b2e633b12e.png)

We’ll be throwing an alert every time any user opens the thread with malicious
script as comment –

**\<script\>alert(“This is a demo of XSS”)\</script\>**

Above script, when submitted as comment, will throw an alert. We can also
execute a much more severe script to vandalize the webpage –

**\<script\>document.documentElement.innerHTML=""\</script\>**

Above script will erase all the HTML written for the victim webpage. This is
highly dangerous for any website.

**Session Fixation**

Session Fixation vulnerabilities can make your users liable to having their
session hijacked. A secure implementation of sessions on your site is key to
protecting your users.

**Severity of Session Fixation –**

Session hijacking allows hackers to bypass user’s authentication scheme with
impunity. This is almost the worst thing that could happen, security-wise – and
neither user nor admin may know when it has occurred!

**Procedure –**

There are several techniques to execute the attack; it depends on how the Web
application deals with session tokens. Below are some of the most common
techniques:

-   Session token in the URL argument: The Session ID is sent to the victim in a
    hyperlink and the victim accesses the site through the malicious URL.

-   Session token in a hidden form field: In this method, the victim must be
    tricked to authenticate in the target Web Server, using a login form
    developed for the attacker. The form could be hosted in the evil web server
    or directly in html formatted e-mail.

-   Session ID in a cookie

In our website, we can demonstrate this attack through two methods, i.e.,

1.  **by passing Session ID through the URL** –

![](media/fe66ba23e849d2afbfb85cd62e76dd9f.png)

1.  **by inspecting cookie after logging in** –

![](media/3ca31b80222eb0fb292f212df1b225f7.png)

**Figure 12 : Session ID is stored as 'PHPSESSID'**

**Cross-Site Request Forgery (CSRF)**

Cross-site request forgery (CSRF) vulnerabilities can be used to trick a user’s
browser into performing an unwanted action on your site. Any function that your
users can perform deliberately is something they can be tricked into performing
inadvertently using CSRF.

**Severity of CSRF –**

CSRF attacks in the past have been used to:

-   Steal confidential data.

-   Spread worms on social media.

-   Install malware on mobile phones.

It is hard to estimate the prevalence of CSRF attacks; often the only evidence
is the malicious effects caused by the attack. CSRF is routinely described as
one of the top-ten security vulnerabilities by OWASP.

**Procedure –**

In a Cross-Site Request Forgery attack, the attacker is exploiting how the
target web application manages authentication. For CSRF to be exploited, the
victim must be authenticated against (logged into) the target site.

For instance, in our forum website, we’ll be exploiting “**login**” form
authentication. Hacker copies the code responsible for the form using “**Page
Source**” into his own website.

![](media/b28e38b8ef7b05ea4731b3e78307ea6b.png)

If any user tries to login from the attacker’s website, he’ll be redirected to
our vulnerable website, logged in by his credentials. Attacker can perform much
devastating actions through CSRF.

**Attack Execution:**

**SQL Injection:**

![](media/72aaf8a8dd506693a7948778fd19eb58.png)

**Figure 13 : Injecting SQL in Password field (SQL Injection using WHERE
clause)**

**Session Fixation:**

**![](media/0c2679e95dd4a9d06d742a57c63597b9.png)**

**Figure 14 : Session Fixation (Same Session ID in both instances - User's
session hijacked)**

**Cross-Site Scripting –**

**![](media/318a2896e8359093e970e067dbd020a8.png)**

**Figure 15 : XSS - (i) Inserting script as comment into databse**

![](media/609c6a8f2058b5ac615ffbe40ee2718d.png)

**Figure 16 : XSS - (ii) Script gets executed every time data is fetched**

**![](media/2699f1488f776f86d27b11df58314aea.png)**

**Figure 17 : XSS - (iii) Script gets successfully stored into Database**

**Cross-Site Request Forgery -**

![](media/9e9ca3f4aaf8f071b643a8c917db4915.png)

**Figure 18 : CSRF - (i) Attacker copies \<form\> tag content from victim's
website**

![](media/1c2768c4f8ce174a18108f9bd1a3f796.png)

**Figure 19 : CSRF - (ii) Attacker copies the same content and parses request to
DB from his own website**

![](media/3a9dfd21bd6d420b50ed99d87181fe02.png)

**Figure 20 : CSRF - (iii) Attacker's website with login form redirected to
victim's website**

**Prevention Techniques:**

**SQL Injection**

Parameterized Statements

Programming languages talk to SQL databases using database drivers. A driver
allows an application to construct and run SQL statements against a database,
extracting and manipulating data as needed. Parameterized statements make sure
that the parameters (i.e., inputs) passed into SQL statements are treated in a
safe manner.

Object Relational Mapping

Many development teams prefer to use Object Relational Mapping (ORM) frameworks
to make the translation of SQL result sets into code objects more seamless. ORM
tools often mean developers will rarely have to write SQL statements in their
code – and these tools thankfully use parameterized statements under the hood.

Using an ORM does not automatically make you immune to SQL injection, however.
Many ORM frameworks allow you to construct SQL statements, or fragments of SQL
statements, when more complex operations need to be performed on the database.

Escaping Inputs

Injection attacks often rely on the attacker being able to craft an input that
will prematurely close the argument string in which they appear in the SQL
statement.

Typically, doubling up the quote character – replacing ' with '' – means “treat
this quote as part of the string, not the end of the string”.

Escaping symbol characters is a simple way to protect against most SQL injection
attacks, and many languages have standard functions to achieve this.

**stripslashes()** can be used if you aren't inserting this data into a place
(such as a database) that requires escaping.

**mysqli_real_escape_string** — Escapes special characters in a string for use
in an SQL statement, taking into account the current charset of the connection

Sanitizing Inputs

Sanitizing inputs is a good practice for all applications. In our example hack,
the user supplied a password as ' or 1=1--, which looks pretty suspicious as a
password choice.

Developers should always make an effort to reject inputs that look suspicious
out of hand, while taking care not to accidentally punish legitimate users.

**  
**

**Session Fixation**

Don’t Pass Session IDs in GET/POST Variables

Programming languages Passing session IDs in query strings, or in the body of
POST requests, is problematic. Not only does it make crafting of malicious URLs
possible, but session IDs can be leaked in the following ways:

-   If the user follows an out-bound link (the Referrer header will describe
    where the user browsed from).

-   In the browser history and in bookmarks.

-   In logs on your web server, and any proxy servers.

    Session IDs are better passed in HTTP cookies.

    Regenerate the Session ID at Authentication

    Session fixation attacks can be defeated by simply regenerating the session
    ID when the user logs in.

    **session_regenerate_id** — Update the current session id with a newly
    generated one

    Accept Only Server-Generated Session IDs

    It is a good practice to ensure that only server-generated session IDs are
    accepted by your web server. (On its own, this won’t resolve session
    fixation vulnerabilities, though. A hacker can easily get a new
    server-generated ID and pass it onto a victim in a crafted URL.)

    Timeout and Replace Old Session IDs

    Periodically replace session IDs as a second layer of defense, should they
    get leaked.

    Implement a Strong Logout Function

    The logout function on your website should mark session IDs as obsolete.

    Require a New Session When Visiting from Suspicious Referrers

    Forcing users to login again, if they visit your site from a separate
    website (e.g., web-mail).

**Cross-Site Scripting (XSS)**

Sanitize HTML

Some sites have a legitimate need to store and render raw HTML, especially now
that contentEditable has become part of the HTML5 standard. If your site stores
and renders rich content, you need to use a HTML sanitization library to ensure
malicious users cannot inject scripts in their HTML submissions.

Whitelist Values

If a particular dynamic data item can only take a handful of valid values, the
best practice is to restrict the values in the data store, and have your
rendering logic only permit known good values. For instance, instead of asking a
user to type in their country of residence, have them select from a drop-down
list.

Implement a Content-Security Policy

Modern browsers support Content-Security Policies that allow the author of a
web-page to control where JavaScript (and other resources) can be loaded and
executed from. XSS attacks rely on the attacker being able to run malicious
scripts on a user’s web page - either by injecting inline \<script\> tags
somewhere within the \<html\> tag of a page, or by tricking the browser into
loading the JavaScript from a malicious third-party domain.

By setting a content security policy in the response header, you can tell the
browser to never execute inline JavaScript, and to lock down which domains can
host JavaScript for a page.

Escape Dynamic Content

Web pages are made up of HTML, usually described in template files, with dynamic
content woven in when the page is rendered. Stored XSS attacks make use of the
improper treatment of dynamic content coming from a backend data store. The
attacker abuses an editable field by inserting some JavaScript code, which is
evaluated in the browser when another user visits that page.

We should escape all dynamic content coming from a data store, so the browser
knows it is to be treated as the contents of HTML tags, as opposed to raw HTML.
Escaping editable content in this way means it will never be treated as
executable code by the browser. This closes the door on most XSS attacks.

**strip_tags** — Strip HTML and PHP tags from a string

**Cross-Site Request Forgery (CSRF)**

REST

Representation State Transfer (REST) is a series of design principles that
assign certain types of action (view, create, delete, update) to different HTTP
verbs. Following REST-ful designs will keep your code clean and help your site
scale. Moreover, REST insists that GET requests are used only to view resources.
Keeping your GET requests side-effect free will limit the harm that can be done
by maliciously crafted URLs–an attacker will have to work much harder to
generate harmful POST requests.

Anti-Forgery Tokens

In order to ensure that you only handle valid HTTP requests you need to include
a secret and unique token with each HTTP response, and have the server verify
that token when it is passed back in subsequent requests that use the POST
method (or any other method except GET, in fact.) This is called an anti-forgery
token. Each time your server renders a page that performs sensitive actions, it
should write out an anti-forgery token in a hidden HTML form field. This token
must be included with form submissions, or AJAX calls. The server should
validate the token when it is returned in subsequent requests, and reject any
calls with missing or invalid tokens.

Anti-forgery tokens are typically (strongly) random numbers that are stored in a
cookie or on the server as they are written out to the hidden field. The server
will compare the token attached to the inbound request with the value stored in
the cookie. If the values are identical, the server will accept the valid HTTP
request.

Include Addition Authentication for Sensitive Actions

Many sites require a secondary authentication step, or require re-confirmation
of login details when the user performs a sensitive action. (Think of a typical
password reset page – usually the user will have to specify their old password
before setting a new password.) Not only does this protect users who may
accidentally leave themselves logged in on publicly accessible computers, but it
also greatly reduces the possibility of CSRF attacks.

**Results:**

**SQL Injection**

![](media/b2b9d011337d0ea4197366adab004eb1.png)

**Figure 21 : stripslashes( ) and mysqli_real_escape_string( )**

**Session Fixation**

![](media/6915e75c8662b8ee4c15191cb9039bb7.png)

**Figure 22 : session_regenerate_id(true) - used to generate new sessionID after
authentication**

**Cross-Site Scripting (XSS)**

**![](media/c33fa4e6ab1ed1b62eee7c19e8fc4d8f.png)**

**Figure 23 : XSS – (i) strip_tags() used to strip HTML/PHP tags from a string**

**![](media/32ae750fea23b7c17d8ac256992a0446.png)**

**Figure 24 : XSS- (ii) Tags have been stripped away from comment and then
posted into Database**

![](media/ea13df8c8a8df18fa4cf9012ce68eb63.png)

**Figure 25 : XSS - (iii) Comment posted in the database after removing tags**

**  
**

**Cross-Site Request Forgery (CSRF)**

![](media/15b429c52ec49fa58552b4d9bb7ee0f0.png)

**Figure 26 : CSRF – (i) CSRF_Token generator function**

![](media/ce9beaee6933cea333a98e859814175c.png)

**Figure 27 : CSRF – (ii) CSRF_Token Validation while logging in**

**  
**![](media/cdefc6114a5d19b513b888d6835cc801.png)

**Figure 28 : CSRF - (iii) When someone tries to login from attacker's website,
CSRF_Token won't be validated**

![](media/5cdca1d644321dae55b1f5a57ce96c4c.png)

**Figure 29 : CSRF - (iv) CSRF_Token changes value everytime page gets
refreshed**

**Conclusion:**

We conclude that following attacks have been a major threat to many large
corporations across the globe but many methods have been introduced in order to
prevent these attacks from vandalizing the websites and invading user’s privacy.
We discussed some methods regarding their execution and prevention in our
custom-made forum website.

Using these methods, we’ve been successfully able to demonstrate the attacks and
their prevention.

**References:**

-   **Group demo presentation (Attacks & Prevention) –**

    [**https://youtu.be/1vmXiUhjjPE**](https://youtu.be/1vmXiUhjjPE)

-   SQL Injection \| *OWASP* -
    <https://owasp.org/www-community/attacks/SQL_Injection>

-   Protecting against SQL Injection \| *Hacksplaining* -
    <https://www.hacksplaining.com/prevention/sql-injection>

-   Session Fixation software attack \| *OWASP* –

    <https://owasp.org/www-community/attacks/Session_fixation>

-   Protecting your users against session fixation \| *Hacksplaining* –

    <https://www.hacksplaining.com/prevention/session-fixation>

-   Cross Site Scripting software attack \| *OWASP* –

    <https://owasp.org/www-community/attacks/xss/>

-   Protecting your users against cross-site scripting \| *Hacksplaining* –

    <https://www.hacksplaining.com/prevention/xss-stored>

-   Cross-site Request Forgery \| *OWASP* –

    <https://owasp.org/www-community/attacks/csrf>

-   Protecting your users against CSRF \| *Hacksplaining* –

    <https://www.hacksplaining.com/prevention/csrf>
