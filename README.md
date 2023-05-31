# Class-Assignment-XSS-CSRF
- For this assignment, I have modified the previous assignments codes that have implemented the Same Origin Policy, Content Security Policy (CSP) and XSS Defense.
## Same Origin Policy
- In index.php and login.php, I have added relative path (./) to the form action attribute to ensure that the form data is submitted to the same origin as the current page.
## Content Security Policy (CSP)
- In register.php, I have added Content Security Policy meta tag to the head section of the code. The policy defined in the meta tag restricts the sources from which scripts can be loaded, allowing only the scripts from the same origin to be executed.
## XSS Defense
- In register.php and server,php, I have used the function 'htmlspecialchars', Regexes and blacklisting to sanitize user input before executing it.
## CSRF Defense
- In server.php, register.php and login.php, I included CSRF token as a hidden input field in the forms and validating it in the server-side code. It ensures that the requests originated from the same site and mitigate the risk of CSRF attacks.
