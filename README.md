tequilaTool
===========

Tequila Tool

URL: https://github.com/agustincl/tequilaTool

1. Hacer un fork

Entras en el directorio donde tienes el proyecto y haces los siquientes comandos:

git init

git clone "vuesto repo de github, sin estas comillas"

Para hacer subir los cambios, dentro de tu directorio:
---
git add .

git commit -m "asunto del commit, estas comillas con necesarias"

git push



___

Como participar en TequilaTool
---
1. Hacer un fork de este proyecto
El resultado es que se crea un fork en tu cuenta de gitHub de TequilaTool

2. Hacer un clone a la maquina de desarrollo
El resultado es que "descargas" el proyecto en la maquina de desarrollo y aparece el directorio TequilaTool con todo el codigo.
git clone git@github.com:<your-account>/<your-repo>.git

3. Hacer un VirtualHost al proyecto en la maquina de desarrollo 
El resultado es que ahora puedes ir a tequilTool.local y ver que es TequilaTool

4. Necesitas crear y llenar la base de datos.

5. Mejoras, aportas y compartes tu codigo.
Esto significa que le "subes" a tu cuenta de github.
5.1 git add * 
5.1 Si necesitas agregar archivos eliminados en lugar usa git add -u
5.2 git commit -m "algun comentario que idenfique el cambio"
5.3 git push origin

6. Agregar otro remote al repositorio
Esto es para que puedas siincronizarte con Tequila
git remote add tequila https://github.com/agustincl/tequilaTool.git

7. Sincronizar tu repositorio con Tequila
git pull tequila master

8. Enviar pull request a Tequila
Si quieres que tu codigo llegue a Tequila necesitas hacer un pull request desde tu fork al proyecto Tequila.
Encontraras el boton en la parte superior del menu en github.



