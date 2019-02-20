package main

import (
	"context"
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

	// 登録するドキュメントを作成
	chatData := Chat{
		User:    "user01",
		Message: "test message",
		Created: time.Now(),
		Tag:     "tag01",
	}

	indexDoc, err := client.Index().Index("chat").Type("chat").Id("I").BodyJson(&chatData).Do(ctx)
	if err != nil {
		panic(err)
	}

	fmt.Printf("Index/Type:%s/%sへドキュメント（ID:%s）が登録されました\n", indexDoc.Index, indexDoc.Type, indexDoc.Id)
}
