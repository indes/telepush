package bot

import (
	"errors"

	"github.com/indes/telepush/internal/config"
	_ "github.com/indes/telepush/internal/log"
	"go.uber.org/zap"
	tb "gopkg.in/tucnak/telebot.v2"
)

func NewBot() (*tb.Bot, error) {
	bot, err := tb.NewBot(tb.Settings{
		Token: config.BotToken,
	})

	if err != nil {
		zap.S().Errorf("NewBot failed, err %v", err)
		return nil, err
	}

	return bot, nil
}

func Notify(reciverId int64, msg *tb.Message) error {

	bot, err := NewBot()
	if err != nil {
		return errors.New("Get telegram bot failed")
	}

	reciver := &tb.User{
		ID: int(reciverId),
	}

	if _, err := bot.Send(reciver, msg); err != nil {
		zap.S().Errorf("bot send message failed, to: %v msg: %v err: %v", reciverId, msg, err)
		return errors.New("Telegram bot send message failed,")
	}

	return nil
}

func NotifyTxtMessage(reciverId int, msg string) error {

	bot, err := NewBot()
	if err != nil {
		return errors.New("Get telegram bot failed")
	}

	reciver := &tb.User{
		ID: reciverId,
	}

	if _, err := bot.Send(reciver, msg); err != nil {
		zap.S().Errorf("bot send message failed, to: %v msg: %v err: %v", reciverId, msg, err)
		return errors.New("Telegram bot send message failed,")
	}

	return nil
}
