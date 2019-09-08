# :computer: Virtual Hosts Cli
Create Virtual Hosts for apache with one click

## :wrench: Installation
Install with Composer as global for best perfomance
```
composer global require abo3adel/vhost
```
#### :heavy_exclamation_mark: Reqirements:
* php: 7.3 or newer
* symfony/console: 3.4.23


## :sparkles: Usage
**:heavy_exclamation_mark: Note:** Run as Administrator

There are two ways:
### :fax: Options Way:
```ps 
C:\xampp\htdocs\project> vhost add -s "project.test"
Creating Virtual Host From this data
========================================

------------------------------------------------------------
ServerName              project.test
------------------------------------------------------------
DocumentRoot            "C:\xampp\htdocs\project"
------------------------------------------------------------
ServerAdmin             
------------------------------------------------------------
ServerAlias             
------------------------------------------------------------
ErrorLog                ""
------------------------------------------------------------
CustomLog               ""
------------------------------------------------------------

Existing Application, GoodBuy.
```

#### All Avaliable options:

* add [-s|--server **[Server Name]**] **[Required]**
* [-d|--dir [Path to Server Directory]] **[Optinal]** Defaults to **CurrentDirectory**
* [-a|--admin **[Admin Email]**] **[Optinal]**
* [-l|--alias **[Server Alias]**] **[Optinal]**
* [-e|--error-log **[Error Log]**] **[Optinal]**
* [-c|--custom-log **[Custom Log]**] **[Optinal]**
```ps
    C:\xampp\htdocs\project> vhost add -s "project.test" -d "C:\xampp\htdocs\someOtherApp" -a "example@some.com" -l "dev.preoject.test" -e "path/to/error/file.log" -c "path/to/custom/file.log"
```
---
### :gift: Interactive Mode:
```ps
C:\xampp\htdocs\project> vhost i

Creating Virutal Host From this data
====================================

 Server Name ["project.com"]:
 >

 Server Directory ["C:\xampp\htdocs\project"]:
 >

 Server Admin Email []:
 >

 Server Alias []:
 >

 Error Log File []:
 >

 Custom Log File []:
 >

```

