```
  #notes.local
  127.0.0.1       notes.local
  127.0.0.1       www.notes.local
```

```xml
  <VirtualHost *:80>
      ServerName notes.local
      ServerAlias www.notes.local

      DocumentRoot "C:\xampp\htdocs\projects\js_codepen\laravelAPIserver\public"


      CustomLog "C:\xampp\htdocs\projects\js_codepen\laravelAPIserver\storage\logs\notes.local-access.log" common
      ErrorLog  "C:\xampp\htdocs\projects\js_codepen\laravelAPIserver\storage\logs\notes.local-error.log"
  </VirtualHost>

```
