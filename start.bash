sudo service apache2 start
sudo service mysql start
# ./tailwindcss -i  ./app/public/css/input.css -o ./app/public/css/output.css --watch
./tailwindcss -i  ./app/public/css/input.css -o ./app/public/css/output.css --minify
 set -o allexport; source .env; set +o allexport