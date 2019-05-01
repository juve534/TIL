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

	// TermQueryで完全一致で検索する
	query := elastic.NewTermQuery("tag", "ドラえもん")
	results, err := client.Search().Index("chat").Query(query).Do(ctx)
	if err != nil {
		panic(err)
	}

	var chattype Chat
	for _, chat := range results.Each(reflect.TypeOf(chattype)) {
		if c, ok := chat.(Chat); ok {
			fmt.Printf("Tag: %s and Chat message is: %s \n", c.Tag, c.Message)
		}
	}
}
