package main

import (
	"log"
	"time"
)

func main()  {
	ticker := time.NewTicker(10 * time.Second)
	defer ticker.Stop()

	for {
		select {
		case <-ticker.C:
			log.Println("HELL-SEE")
		}
	}

	log.Fatalln("END")
}