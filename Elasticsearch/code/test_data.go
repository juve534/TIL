package main

import (
	"context"
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

	// 登録するドキュメントを作成
	chatData01 := Chat{
		User:    "user01",
		Message: "明日は期末テストがあるけどなんにも勉強していない",
		Created: time.Now(),
		Tag:     "試験",
	}

	chatData02 := Chat{
		User:    "user02",
		Message: "時々だけど勉強のやる気が出るけど長続きしない",
		Created: time.Now(),
		Tag:     "学習",
	}

	chatData03 := Chat{
		User:    "user03",
		Message: "あと十年あれば期末テストもきっと満点が取れたんだろう",
		Created: time.Now(),
		Tag:     "試験",
	}

	chatData04 := Chat{
		User:    "user04",
		Message: "ドラえもんの映画で好きなのは夢幻三剣士だな",
		Created: time.Now(),
		Tag:     "ドラえもん",
	}

	chatData05 := Chat{
		User:    "user05",
		Message: "世界記憶の概念、そうアカシックレコードを紐解くことで解は導かれるかもしれない",
		Created: time.Now(),
		Tag:     "ファンタジー",
	}

	_, err = client.Index().Index("chat").Type("chat").Id("1").BodyJson(&chatData01).Do(ctx)
	if err != nil {
		panic(err)
	}
	_, err = client.Index().Index("chat").Type("chat").Id("2").BodyJson(&chatData02).Do(ctx)
	if err != nil {
		panic(err)
	}
	_, err = client.Index().Index("chat").Type("chat").Id("3").BodyJson(&chatData03).Do(ctx)
	if err != nil {
		panic(err)
	}
	_, err = client.Index().Index("chat").Type("chat").Id("4").BodyJson(&chatData04).Do(ctx)
	if err != nil {
		panic(err)
	}
	_, err = client.Index().Index("chat").Type("chat").Id("5").BodyJson(&chatData05).Do(ctx)
	if err != nil {
		panic(err)
	}

}
