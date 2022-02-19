# Petshop

## # Installation Steps

- Clone the project
- Run the project containers using
```bash
bash ./petshop up
```
- Add a local domain in hosts file
```bash
sudo sh -c "echo 127.0.0.1       petshop.local >> /etc/hosts"
```
---
- To stop petshop running containers
```bash
bash ./petshop down
```
- To access phpmyadmin use `http://petshop.local:8082`
