# Laravel Server
## install protobuf
```
cd [project-dir]
sudo apt update
sudo apt install protobuf-compiler
```

## composer protobuf
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
---
# Go Server
## install Golang
```
cd /tmp
wget https://go.dev/dl/go1.22.6.linux-amd64.tar.gz
sudo rm -rf /usr/local/go
sudo tar -C /usr/local -xzf go1.22.6.linux-amd64.tar.gz
go version
```

## install protoc-gen-go
```
cd /tmp
go install google.golang.org/protobuf/cmd/protoc-gen-go@latest
protoc-gen-go --version
```

## add go/bin to PATH in .bashrc
```
echo 'export PATH="$PATH:$HOME/go/bin"' >> ~/.bashrc
source ~/.bashrc
```

## import protobuf
```
cd [project-dir]
go get google.golang.org/protobuf@latest
go list -m all | grep protobuf
```

## create proto
```
cd [project-dir]
protoc --proto_path=proto \
       --go_out=gen \
       --go_opt=paths=source_relative \
       ./proto/v1/health.proto
```
