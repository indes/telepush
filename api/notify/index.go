package handler

import (
	"fmt"
	"net/http"
	"strconv"

	"github.com/indes/telepush/internal/bot"
)

func Handler(w http.ResponseWriter, r *http.Request) {
	fmt.Fprintf(w, "hello telepush\n")

	params := r.URL.Query()
	userId, _ := strconv.Atoi(params.Get("u"))
	msg := params.Get("m")

	if err := bot.NotifyTxtMessage(userId, msg); err != nil {
		fmt.Fprintf(w, "send message to %d failed!", userId)
		return
	}

	fmt.Fprintf(w, "send message to %d succes!", userId)

}
