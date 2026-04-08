# Laravel Server
## install protobuf compiler
```
cd [project-dir]
sudo snap install protobuf --classic
```

## install protobuf library for php
```
cd [project-dir]
composer require google/protobuf
```

## create proto
```
cd [project-dir]
protoc --php_out=./protobuf/php \
       ./protobuf/protos/v1/health.proto
```
