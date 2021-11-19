# lakderena

1. clone the repository to your local machine:<br>
**_C:\xampp\htdocs_**
2. set up the host in your local machine:</br>
I. go to below file and add the following <br> **_C:\xampp\apache\conf\extra\httpd-vhosts.conf_**<br>

```
<VirtualHost *:80>
    ServerAdmin lakderena.local
    DocumentRoot "C:/xampp/htdocs/lakderena"
    ServerName lakderena.local
    ErrorLog "logs/dummy-host2.example.com-error.log"
    CustomLog "logs/dummy-host2.example.com-access.log" common
</VirtualHost>
```

II. go to below file and add the following under localhost names
**_C:\Windows\System32\drivers\etc\hosts_**

```
127.0.0.1		lakderena.local
```

3. go to project root folder and run composer install command

```
composer install
```

4. create a new branch from **main** branch

```
git checkout -b yourname/branch_name
```

5. set up the database and name it as **lakderena**

6. up the project:<br>
go to your favourite browser and type 

```
lakderena.local
```

All set and now you can start your development!!!



