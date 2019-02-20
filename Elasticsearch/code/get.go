package main

import (
	"context"
	"encoding/json"
	"fmt"
	"time"

	"github.com/olivere/elastic"
)

type Chat struct {
	User    string    `json:"user"`
	Message string    `json:"message"`
	Created time.Time `json:"created"`
	Tag     string    `json:"tag"`
}

func main() {
	esURL := "http://127.0.0.1:9200"
	ctx := context.Background()
	client, err := elastic.NewClient(
		elastic.SetURL(esURL),
	)

	if err != nil {
		panic(err)
	}

	document, err := client.Get().Index("chat").Type("chat").Id("I").Do(ctx)
	if err != nil {
		panic(err)
	}

	if document.Found {
		var chat Chat
		err := json.Unmarshal(*document.Source, &chat)
		if err != nil {
			panic(err)
		}

		fmt.Printf("Message:<%s>created by %s \n", chat.Message, chat.User)
	}
}
