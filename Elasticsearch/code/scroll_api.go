package main

import (
	"context"
	"fmt"
	"reflect"
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
	esURL := "http://192.168.33.55:9200"
	ctx := context.Background()
	client, err := elastic.NewClient(
		elastic.SetURL(esURL),
		elastic.SetSniff(false),
	)

	if err != nil {
		panic(err)
	}

	// Scroll APIで絞り込み
	query := elastic.NewMatchQuery("message", " テスト ")
	results, err := client.Scroll("chat").Query(query).Size(1).Do(ctx)
	if err != nil {
		panic(err)
	}

	var chattype Chat
	for _, chat := range results.Each(reflect.TypeOf(chattype)) {
		if c, ok := chat.(Chat); ok {
			fmt.Printf("Chat message is: %s \n", c.Message)
		}
	}

	// 先程の検索結果の続きを取得する
	nextResults, err := client.Scroll("chat").Query(query).Size(1).ScrollId(results.ScrollId).Do(ctx)
	if err != nil {
		panic(err)
	}

	for _, chat := range nextResults.Each(reflect.TypeOf(chattype)) {
		if c, ok := chat.(Chat); ok {
			fmt.Printf("ScrollId Chat message is: %s \n", c.Message)
		}
	}
}
