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

	// meesage に「テスト」か「試験」を含み、user01のメッセージ以外を検索する
	query := elastic.NewBoolQuery();
	query.Should(
		elastic.NewMatchQuery("message", " テスト "),
		elastic.NewMatchQuery("message", " 試験 "),
	)
	query.MustNot(
		elastic.NewTermQuery("user", "user01"),
	)
	results, err := client.Search().Index("chat").Query(query).Do(ctx)
	if err != nil {
		panic(err)
	}

	var chattype Chat
	for _, chat := range results.Each(reflect.TypeOf(chattype)) {
		if c, ok := chat.(Chat); ok {
			fmt.Printf("Chat message is: %s \n", c.Message)
		}
	}
}
