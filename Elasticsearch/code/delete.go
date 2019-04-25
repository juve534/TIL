package main

import (
	"context"
	"fmt"

	"github.com/olivere/elastic"
)

func main() {
	esURL := "http://127.0.0.1:9200"
	ctx := context.Background()
	client, err := elastic.NewClient(
		elastic.SetURL(esURL),
	)

	if err != nil {
		panic(err)
	}

	deleted, err := client.Delete().Index("chat").Type("chat").Id("I").Do(ctx)
	if err != nil {
		panic(err)
	}
	fmt.Printf(deleted.Result)
}
