# Telepush

Vercel Telegram 消息推送机器人

## 一键部署

<a href="https://vercel.com/new/project?template=https://github.com/indes/telepush"><img src="https://vercel.com/button"></a>

## 使用
发送消息
```
curl -X GET http://<your_url>/api/notify?u=123&m=HelloWorld
```

路由参数说明

| url 路径   | 参数（类型, 说明）     | 说明         |
| ---------- | ---------------------- | ------------ |
| api/notify | m(消息内容)，u(telegram用户id) | 发送文字消息 |