# Telepush
Telegram 推送机器人


## 安装
### now 搭建
建议部署在 now 上，免费的套餐够用。
部署教程参考这篇文章：[📟如何搭建一个属于自己的 Telegram 推送 Bot - 瞎说](https://hesay.me/posts/your-own-telegram-push-service/)

### vps 安装
1. 下载代码
```shell
git clone https://github.com/indes/telepush
cd telepush
```

2. 安装依赖
```shell
composer install
```

3. 修改配置文件
```shell
cp .env.example .env
```

参考下面格式修改 .env
```shell
BOT_TOKEN=<Telegram bot token>
OWNER_ID=<你的 Telegram id>
PROXY=<如果服务器不能正常访问telegram api服务器，请设置代理，例如：socks5h://127.0.0.1:1080，否则此项留空>
```

4. 本地测试
```
php -S localhost:8080 -t public
```

## 使用
发送消息
```
curl -X GET http://<your_url>:<port>/api/msg?text=HelloWorld
```

发送图片
```
curl -X GET http://<your_url>:<port>/api/photo?url=https://i.loli.net/2018/12/07/5c0a36e08ec6d.jpg
```

路由说明

|url 路径|参数（类型, 说明）|说明|
| ------ | ------ | ------ |
|api/msg |text(String，消息内容)|发送文字消息|
|api/photo |url(String，发送的图片地址)|发送图片消息|
