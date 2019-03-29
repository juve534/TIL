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
		panic(err);
	}

	info, _, err := client.Ping(esURL).Do(ctx)
	fmt.Printf("Elasticsearch version %s\n", info.Version.Number)
}