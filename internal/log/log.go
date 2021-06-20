package log

import (
	"go.uber.org/zap"
	"go.uber.org/zap/zapcore"
)

var (
	// Logger 日志对象
	Logger    *zap.Logger
	zapConfig zap.Config
)

func init() {
	zapConfig.Level = zap.NewAtomicLevelAt(zapcore.DebugLevel)
	zapConfig.EncoderConfig = zap.NewDevelopmentEncoderConfig()

	zapConfig.EncoderConfig.EncodeTime = zapcore.RFC3339TimeEncoder
	zapConfig.OutputPaths = []string{"stderr"}
	zapConfig.ErrorOutputPaths = []string{"stderr"}
	zapConfig.EncoderConfig.EncodeLevel = zapcore.CapitalColorLevelEncoder
	zapConfig.Encoding = "console"

	Logger, _ = zapConfig.Build()
	zap.ReplaceGlobals(Logger)
}
