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

.env
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
```
curl -X GET http://<your_url>:<port>/api/send?msg=HelloWorld
```
