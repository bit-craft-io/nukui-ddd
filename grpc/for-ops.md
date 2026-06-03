# Summary
- 作業で使用するコマンド
- 作業はWSLを想定

## env value
```
_PROJECT_DIR=/var/www/bc.draft
PROTOC=protoc
```

## install protobuf compiler
```
cd $_PROJECT_DIR
sudo snap install protobuf --classic
```

## install protobuf library for php
```
cd $_PROJECT_DIR
composer require google/protobuf
```

## create proto
```
cd $_PROJECT_DIR
$PROTOC --php_out=./proto/php ./proto/gen/health.proto
protoc --php_out=./proto/php ./proto/gen/health.proto
```
